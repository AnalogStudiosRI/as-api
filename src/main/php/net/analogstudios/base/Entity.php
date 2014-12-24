<?php

 /**
  * 
  * @author Owen Buckley
  * @email owen@analogstudios.net
  * @api as-api
  * @package net\analogstudios\base
  * @class Entity
  * @internal
  * 
  * @since 0.3.0
  * 
  * @copyright 2014
  * 
  */
namespace net\analogstudios\base;

/**
 * Description of Entity
 *
 * @author obuckley
 */
abstract class Entity {
  private $name;

  abstract protected function getName ();
}
