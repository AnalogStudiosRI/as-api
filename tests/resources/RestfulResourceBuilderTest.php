<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/base/AbstractRestfulResource.php";
require_once "src/services/RestfulDatabaseService.php";
require_once "src/resources/EventsResource.php";
require_once "src/resources/RestfulResourceBuilder.php";

use base as base;
use resources as resource;

class RestfulEntityBuilder extends PHPUnit_Framework_TestCase{
  private $DB_CONFIG = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=analogstudios_prod",
    "username" => "astester",
    "password" => "4e7RqGEhtHKHAX6AtYnc"
  );

  public function setup(){

  }

  public function tearDown(){

  }

  public function testBuildRestfulEventsEntity(){
    $builder = new resource\RestfulResourceBuilder($this->DB_CONFIG, 'events');
    $resource = $builder->getResource();

    $this->assertTrue($resource instanceof resource\EventsResource);
    $this->assertTrue(is_subclass_of($resource, base\AbstractRestfulResource::class, false));
  }

}
?>