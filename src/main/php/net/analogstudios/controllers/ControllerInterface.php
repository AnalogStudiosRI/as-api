<?php

namespace net\analogstudios\controllers;

interface ControllerInterface{

  public function get($id = null, $filters = array());

  public function create($params = array());

  public function update($params = array());

  public function delete($ids = array());

}
?>