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
    $obj->skills->strength = $competences->where('idnomcompetence', 8)->first()->niveau;
    $obj->skills->smartness = $competences->where('idnomcompetence', 5)->first()->niveau;
    $obj->skills->agility = $competences->where('idnomcompetence', 6)->first()->niveau;
    $obj->skills->dissimulation = $competences->where('idnomcompetence', 4)->first()->niveau;
    $obj->skills->endurance = $competences->where('idnomcompetence', 7)->first()->niveau;

    $obj->inventory = array();

    return $obj;

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
    $obj->status = ($mission->statut > 0);

    return $obj;
  }

}
