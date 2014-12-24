<?php

namespace net\analogstudios\core;

use net\analogstudios\base as base;

 /**
  * 
  * @author Owen Buckley
  * @email owen@analogstudios.net
  * @api as-api
  * @package net\analogstudios\core
  * @uses net\analogstudios\base net\analogstudios\base
  * @class RestfulEntity
  * @internal
  * 
  * @since 0.3.0
  * 
  * @copyright 2014
  * 
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
