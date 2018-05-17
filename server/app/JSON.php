<?php

namespace App;


class JSON
{

  static public function success($json) {
    $obj->success = $json;
    return json_encode($obj);
  }

  static public function error($json) {
    $obj->error = $json;
    return json_encode($obj);
  }

}
