<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/base/AbstractRestfulResource.php";
require_once "src/resources/EventsResource.php";
require_once "src/resources/RestfulResourceBuilder.php";
require_once "src/services/ConfigService.php";
require_once "src/services/RestfulDatabaseService.php";

use resources as resource;
use services as service;

class RestfulEntityBuilder extends PHPUnit_Framework_TestCase{
  private static $CONFIG = array();
  private static $DB_CONFIG = array();

  public function setup(){
    self::$CONFIG = service\ConfigService::getConfigFromIni('./ini/config-local.ini');
    self::$DB_CONFIG = array(
      "dsn" => "mysql:host=" . self::$CONFIG["db.host"] . ";dbname=" . self::$CONFIG["db.name"],
      "username" => self::$CONFIG["db.user"],
      "password" => self::$CONFIG["db.password"]
    );
  }

  public function tearDown(){
    self::$CONFIG = array();
    self::$DB_CONFIG = array();
  }

  public function testBuildRestfulEventsEntity(){
    $builder = new resource\RestfulResourceBuilder(self::$DB_CONFIG, 'events');
    $resource = $builder->getResource();

    $this->assertTrue($resource instanceof resource\EventsResource);
    $this->assertTrue(is_subclass_of($resource, base\AbstractRestfulResource::class, false));
  }

}