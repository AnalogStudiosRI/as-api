<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/config/Config.php";

use config as config;

class ConfigTest extends PHPUnit_Framework_TestCase{
  private $config;

  public function setup(){
    $this->config = new config\Config('ini/config-env.tmpl.ini');
  }

  public function tearDown(){
    $this->config = null;
  }

  public function testGetConfigSuccess(){
    $cfg = $this->config->getConfig();

    //test database
    $this->assertEquals($cfg['db.host'], 'db-host');
    $this->assertEquals($cfg['db.name'], 'db-name');
    $this->assertEquals($cfg['db.password'], 'db-password');
    $this->assertEquals($cfg['db.user'], 'db-user');

    //test runtime
    $this->assertEquals($cfg['runtime.displayErrors'], 'on-off');

    //test session
    $this->assertEquals( $cfg['session.domain'], 'my-domain.com');
  }
}