<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/main/php/net/analogstudios/base/Database.php";
require_once "src/main/php/net/analogstudios/builders/RestfulEntityBuilder.php";
require_once "src/main/php/net/analogstudios/core/RestfulDatabase.php";
require_once "src/main/php/net/analogstudios/entities/Events.php";

//use net\analogstudios\base as base;
//use net\analogstudios\builders as builder;
//use net\analogstudios\core as core;
//use net\analogstudios\entities as entity;

class RestfulEntityBuilder extends PHPUnit_Framework_TestCase{
  private $DB_CONFIG = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=asadmin_analogstudios_2.0_test",
    "username" => "astester",
    "password" => "t3st3r"
  );
  
  public function setup(){

  }

  public function tearDown(){

  }
  
  public function testBuildRestfulEntityEvents(){
//    $builder = new builder\RestfulEntityBuilder($this->DB_CONFIG, 'events');
//    $entity = $builder->getEntity();
//    
//    $this->assertTrue($entity instanceof entity\Events);
//    $this->assertTrue(is_subclass_of($entity, core\RestfulEntity::class, false));
    
  }

}
?>