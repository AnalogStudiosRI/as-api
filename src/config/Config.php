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

  private static function checkPathExists($path = ''){
    if(file_exists($path)){
      return true;
    }else{
      return false;
    }
  }

  private static function loadIni($path = ''){
    return parse_ini_file($path, true);
  }

  public static function getConfigFromIni($path = ''){

    if(self::checkPathExists($path)){
      return self::loadIni($path);
    }else{
      throw new \InvalidArgumentException('Invalid Path');
    }
  }

}