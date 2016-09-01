<?php

namespace base;

/**
  *
  * @author Owen Buckley
  * @email owen@analogstudios.net
  * @api as-api
  * @package base
  * @class AbstractRestfulDatabase
  *
  * @since 0.3.0
  *
  * @copyright 2014
  *
  */

abstract class AbstractRestfulDatabase {
  protected $db = null;

  function __construct($dbType = "", $dbConfig = array()){
    switch ($dbType) {
      case 'PDO':
        try {
          $this->db = new \PDO($dbConfig["dsn"], $dbConfig["username"], $dbConfig["password"]);
        } catch(PDOException $e) {
          echo $e->getMessage();
        }
        break;
      default:
        //echo 'throw expection';
    }
  }

  abstract protected function select ($tableName = '', $id = null);
  abstract protected function insert ($tableName = '', $requiredParams = array(), $data = array(), $optionalParams = array());
  abstract protected function update ($tableName = '', $id = null, $updateParams = array(), $params = array());
  abstract protected function delete ($tableName = '', $id = null);
}