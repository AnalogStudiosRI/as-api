<?php 

namespace net\analogstudios\builders;

use \net\analogstudios\core as core;
use \net\analogstudios\models as model;


/**
 * name: RestfulEntityBuilder
 * namespace: net\analogstudios\builders
 *
 * @author Owen Buckley
 */

class RestfulEntityBuilder {
  private $entityType;

  public static $ENTITY_ROUTE_MAPPER = array(
    "EVENTS" => array(
      "TABLE_NAME" => "events",
      "TYPE" => "events"
    )
  );
  
  /**
   * Constructor
   */
  function __construct($dbConfig = array(), $entityType = "") {
    if($dbConfig && count($dbConfig) === 3 && $entityType !== ""){
      $this->entityType = $entityType;
      $this->db = new core\RestfulDatabase($dbConfig);
    }else{
      throw new \InvalidArgumentException('Invalid Constrcutor Params');
      //TODO throw exception
    }
  }

  /**
   *
   * EntityBuilder->buildEntity()
   *
   * @return Entity;
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
   * EntityBuilder->getEntity()
   *
   * @return Entity;
   */
  public function getEntity () {
    return $this->buildEntity();
  }
}
?>