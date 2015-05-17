<?php

namespace config;

/**
 *
 * @author Owen Buckley
 * @email owen@analogstudios.net
 * @api as-api
 * @package config
 * @class Config
 *
 * @since 0.3.0
 *
 * @copyright 2015
 *
 */

class Config{

  private $configPath;

  function __construct($configPath = '') {

    if(file_exists($configPath)){
      $this->configPath = $configPath;
    }else{
      throw new \InvalidArgumentException('Invalid Constructor Params');
    }

  }

  public function getConfig(){
    return parse_ini_file($this->configPath, true);
  }

}