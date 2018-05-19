<?php

namespace App;


class JSON
{

  static public function success($endDate) {
    $obj = new \stdClass;

    $obj->success = true;
    $obj->endDate = $endDate;
    return $obj;
  }

  static public function error($message, $endDate = null) {
    $obj = new \stdClass;

    $obj->error = true;
    $obj->message = $message;
    $obj->endDate = $endDate;
    return $obj;
  }


  static public function errorMission($message, $endDate, $idMission) {
    $obj = new \stdClass;

    $obj->error = true;
    $obj->message = $message;
    $obj->endDate = $endDate;
    $obj->missionID = $idMission;
    return $obj;
  }

  static public function user($user) {
    $obj = new \stdClass;

    $obj->ninja = Self::ninja($user->ninja);
    $obj->missions = Self::missions($user);
    $obj->currentAction = Self::currentAction($user);

    return $obj;
  }

  static public function ninja($ninja) {
    $competences = $ninja->competences;

    $obj = new \stdClass;

    $obj->level = $competences->where('idnomcompetence', 0)->first()->niveau;
    $obj->experience = $competences->where('idnomcompetence', 9)->first()->niveau;
    $obj->experienceMax = $competences->where('idnomcompetence', 10)->first()->niveau;

    $obj->needs = new \stdClass;
    $obj->needs->hunger = new \stdClass;
    $obj->needs->hunger->action = "eat";
    $obj->needs->hunger->value = $competences->where('idnomcompetence', 2)->first()->niveau;
    $obj->needs->energy = new \stdClass;
    $obj->needs->energy->action = "sleep";
    $obj->needs->energy->value = $competences->where('idnomcompetence', 1)->first()->niveau;
    $obj->needs->social = new \stdClass;
    $obj->needs->social->action = "talk";
    $obj->needs->social->value = $competences->where('idnomcompetence', 3)->first()->niveau;

    $obj->skills = new \stdClass;
    $obj->skills->strength = Self::getValueCompByID($competences, 8, 'niveau');
    $obj->skills->smartness = Self::getValueCompByID($competences, 5, 'niveau');
    $obj->skills->agility = Self::getValueCompByID($competences, 6, 'niveau');
    $obj->skills->dissimulation = Self::getValueCompByID($competences, 4, 'niveau');
    $obj->skills->endurance = Self::getValueCompByID($competences, 7, 'niveau');


    $equipment = $ninja->objet;
    if(!empty($equipment)) {
      $equipComp = $equipment->competences;

      $obj->skills->strength += Self::getValueCompByID($equipComp, 8, 'pivot->bonus');
      $obj->skills->smartness += Self::getValueCompByID($equipComp, 5, 'pivot->bonus');
      $obj->skills->agility += Self::getValueCompByID($equipComp, 6, 'pivot->bonus');
      $obj->skills->dissimulation += Self::getValueCompByID($equipComp, 4, 'pivot->bonus');
      $obj->skills->endurance += Self::getValueCompByID($equipComp, 7, 'pivot->bonus');
    }

    $obj->inventory = Self::inventory($ninja->utilisateur);

    return $obj;

  }

  static public function getValueCompByID($competences, $id, $term) {
    $competence = $competences->where('idnomcompetence', $id)->first();
    $value = 0;
    if(!empty($competence)) {
      $value = $competence->$term;
    }

    return $value;
  }

  static public function missions($user) {
    $missions = array();
    $mrealisee = $user->missionRealisee->where('statut', '<', 3);

    $missions[] = Self::mission($mrealisee->where('difficulte', 1)->first());
    $missions[] = Self::mission($mrealisee->where('difficulte', 2)->first());
    $missions[] = Self::mission($mrealisee->where('difficulte', 3)->first());

    return $missions;

  }

  static public function mission($mission) {
    $m = $mission->mission;

    $obj = new \stdClass;

    $obj->id = $mission->idmrealisee;
    $obj->title = $m->nom;
    $obj->description = $m->description;
    $obj->level = $mission->difficulte;
    $obj->status = $mission->statut;
    $obj->endDate = $mission->fin;

    return $obj;
  }

  static public function inventory($user) {

    $equipments = $user->objets;

    $list = array();

    foreach($equipments as $equipment) {
      $obj = new \stdClass;

      $obj->id = $equipment->idobjet;
      $obj->name = $equipment->nom;
      $obj->description = $equipment->description;
      $obj->bonus = Self::equipmentComp($equipment);
      $obj->equipped = ($user->ninja->idobjet === $equipment->idobjet);
      array_push($list, $obj);

    }

    return $list;


  }

  static public function equipmentComp($equipment) {
    $stats = array();
    $competences = $equipment->competences;
    foreach($competences as $competence) {
      $obj = new \stdClass;
      $obj->skill = $competence->nom;
      $obj->bonus = $competence->pivot->bonus;
      array_push($stats, $obj);
    }

    return $stats;

  }

  static public function currentAction($user) {
    $obj = new \stdClass;

    $action = $user->ninja->exercices->where('statut', '<', '3')->first();
    $label = "action";
    if(empty($action)) {
      $action = $user->missionRealisee->filter(function($item) {
        return $item->statut > 0 && $item->statut < 3;
      })->first();
      $label = "mission";
    }

    if(!empty($action)) {
      if($label == "action") {
        if($action->action != "eat" && $action->action != "sleep" && $action->action != "talk") $label = "skill";
        $obj->id = $action->idexercice;
      } else {
        $obj->id = $action->idmrealisee;
      }
      $obj->label = $label;
      $obj->endDate = $action->fin;
      $obj->title = Self::verb($action, $label);
      $obj->name = ($label == "mission") ? "default" : $action->action;

      return $obj;
    } else {
      return null;
    }
  }

  static public function verb($action, $label) {
    $verb = "";
    if($label == "mission") {
      $verb = "remplir une mission";
    } else {
      switch($action->action) {
        case "sleep":
          $verb = "dormir";
          break;

        case "eat":
          $verb = "manger";
          break;

        case "talk":
          $verb = "parler";
          break;

        case "shuriken":
          $verb = "lancer des shurikens";
          break;

        case "hide":
          $verb = "se dissimuler";
          break;

        case "musculation":
          $verb = "se muscler";
          break;

        case "juggle":
          $verb = "jongler";
          break;

        default:
          $verb = "ne rien faire";
          break;
      }
    }

    return $verb;
  }

}
