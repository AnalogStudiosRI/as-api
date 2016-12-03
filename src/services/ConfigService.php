<?php

namespace services;

/**
 *
 * @author Owen Buckley
 * @email owen@analogstudios.net
 * @api as-api
 * @package services
 * @class ConfigService
 *
 * @since 0.3.0
 *
 * @copyright 2015
 *
 */

class ConfigService{

  private static function loadIni($path = ''){
    return parse_ini_file($path, true);
  }

  public static function getConfigFromIni($path = ''){

    if(file_exists($path)){
      return self::loadIni($path);
    }else{
      throw new \InvalidArgumentException('Invalid Path');
    }
  }

}