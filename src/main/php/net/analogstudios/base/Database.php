<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace net\analogstudios\base;

/**
 * Description of DatabaseInterface
 *
 * @author obuckley
 */
abstract class Database {
  //put your code here
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
  abstract protected function insert ($tableName = '', $requiredParams = array(), $params = array());
  abstract protected function update ($tableName = '', $id = null, $updateParams = array(), $params = array());
  abstract protected function delete ($tableName = '', $id = null);
}