<?php

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
