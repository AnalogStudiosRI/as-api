<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace net\analogstudios\core;

use net\analogstudios\base as base;

/**
 * Description of RestfulEntity
 *
 * @author obuckley
 */
abstract class RestfulEntity extends base\Entity{
  protected $db;
  
  function __construct(RestfulDatabase $db) {
    $this->db = $db;
  }
  
  abstract public function getTableName ();
  abstract public function getRequiredCreateParams ();
  abstract public function getAllowedUpdateParams ();
}
