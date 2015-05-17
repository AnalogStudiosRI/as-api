<?php
error_reporting(E_ALL | E_STRICT);

require_once "src/config/Config.php";

use config as config;

class ConfigTest extends PHPUnit_Framework_TestCase{

  public function testGetConfigSuccess(){
    $cfg = new config\Config();
    $config = $cfg->getConfigFromIni('ini/config-env.tmpl.ini');

    //test database
    $this->assertEquals($config['db.host'], 'db-host');
    $this->assertEquals($config['db.name'], 'db-name');
    $this->assertEquals($config['db.password'], 'db-password');
    $this->assertEquals($config['db.user'], 'db-user');

    //test runtime
    $this->assertEquals($config['runtime.displayErrors'], 'on-off');

    //test session
    $this->assertEquals($config['session.domain'], 'my-domain.com');
  }
}