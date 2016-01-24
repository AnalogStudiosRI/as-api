<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/services/RestfulDatabaseService.php";

use services as service;

class RestfulDatabaseTest extends PHPUnit_Framework_TestCase{
  private $db;
  private $dbConfig = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=analogstudios_prod",
    "username" => "astester",
    "password" => "452SsQMwMP"
  );

  public function setup(){
    $this->db = new service\RestfulDatabaseService($this->dbConfig);
  }

  public function tearDown(){
    $this->db = null;
  }

  public function testInstanceOf(){
    $this->assertTrue($this->db instanceof service\RestfulDatabaseService);
  }

  public function testInstanceOfParent(){
    $this->assertTrue($this->db instanceof service\RestfulDatabaseService);
    $this->assertTrue(is_subclass_of($this->db, base\AbstractRestfulDatabase::class, false));
  }
}
?>