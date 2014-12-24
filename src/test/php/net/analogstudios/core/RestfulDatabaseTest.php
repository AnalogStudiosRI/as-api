<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/main/php/net/analogstudios/base/Database.php";
require_once "src/main/php/net/analogstudios/core/RestfulDatabase.php";

use net\analogstudios\base as base;
use net\analogstudios\core as core;

class RestfulDatabaseTest extends PHPUnit_Framework_TestCase{
  private $db;
  private $dbConfig = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=asadmin_analogstudios_2.0_test",
    "username" => "astester",
    "password" => "t3st3r"
  );
  
  public function setup(){
    $this->db = new core\RestfulDatabase($this->dbConfig);
  }

  public function tearDown(){
    $this->db = null;
  }
  
  public function testInstanceOf(){
    $this->assertTrue($this->db instanceof core\RestfulDatabase);
  }
  
  public function testInstanceOfParent(){
    $this->assertTrue($this->db instanceof core\RestfulDatabase);
    $this->assertTrue(is_subclass_of($this->db, base\Database::class, false));
  }
}
?>