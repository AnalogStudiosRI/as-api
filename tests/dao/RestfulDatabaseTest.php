<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/base/AbstractRestfulDatabase.php";
require_once "src/dao/RestfulDatabase.php";

use dao as dao;

class RestfulDatabaseTest extends PHPUnit_Framework_TestCase{
  private $db;
  private $dbConfig = array(
    "dsn" => "mysql:host=127.0.0.1;dbname=asadmin_analogstudios_new_test",
    "username" => "astester",
    "password" => "t3st3r"
  );

  public function setup(){
    $this->db = new dao\RestfulDatabase($this->dbConfig);
  }

  public function tearDown(){
    $this->db = null;
  }

  public function testInstanceOf(){
    $this->assertTrue($this->db instanceof dao\RestfulDatabase);
  }

  public function testInstanceOfParent(){
    $this->assertTrue($this->db instanceof dao\RestfulDatabase);
    $this->assertTrue(is_subclass_of($this->db, base\AbstractRestfulDatabase::class, false));
  }
}
?>