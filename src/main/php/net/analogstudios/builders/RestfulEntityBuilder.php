<?php 

namespace net\analogstudios\builders;

use net\analogstudios\core as core;
use net\analogstudios\models as model;


 /**
  * 
  * @author Owen Buckley
  * @email owen@analogstudios.net
  * @api as-api
  * @package net\analogstudios\builders
  * @uses net\analogstudios\core net\analogstudios\core
  * @uses net\analogstudios\models net\analogstudios\models
  * @class RestfulEntityBuilder
  * 
  * @since 0.3.0
  * 
  * @copyright 2014
  * 
  */
class RestfulEntityBuilder {
  private $entityType;

  public static $ENTITY_ROUTE_MAPPER = array(
    "EVENTS" => array(
      "TABLE_NAME" => "events",
      "TYPE" => "events"
    )
  );

  function __construct($dbConfig = array(), $entityType = "") {
    if($dbConfig && count($dbConfig) === 3 && $entityType !== ""){
      $this->entityType = $entityType;
      $this->db = new core\RestfulDatabase($dbConfig);
    }else{
      throw new \InvalidArgumentException('Invalid Constructor Params');
      //TODO throw exception
    }
  }

  /**
   *
   * @method buildEntity
   *
   * @return RestfulEntity RestfulEntity model
   */
  private function buildEntity(){
    $entity = NULL;
    
    if(self::$ENTITY_ROUTE_MAPPER[strtoupper($this->entityType)]){
      switch ($this->entityType){
        case self::$ENTITY_ROUTE_MAPPER["EVENTS"]["TYPE"]:
          $entity = new model\Events($this->db);
          break;
      }
    }
    
    return $entity;
  }
  
  /**
   *
   * @method getEntity
   *
   * @return RestfulEntity;
   */
  public function getEntity () {
    return $this->buildEntity();
  }
}
?>