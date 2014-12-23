<?php 

namespace net\analogstudios\builders;

use \net\analogstudios\entities as entity;
use \net\analogstudios\core as core;

/**
 * name: EntityBuilder
 * namespace: net\analogstudios\builders
 *
 * @author Owen Buckley
 */

class EntityBuilder {
  private $db;

  public static $ENTITY_ROUTE_MAPPER = array(
    "EVENTS" => array(
      "TABLE_NAME" => "events",
      "TYPE" => "events"
    )
  );
  
  /**
   * Constructor
   */
  function __construct(core\RestfulDatabase $db) {
    if($db){
      $this->db = $db;
    }else{
      //TODO throw exception
    }
  }

  private function buildEntity($entityType){
    $entity = NULL;
    
    if(self::$ENTITY_ROUTE_MAPPER[strtoupper($entityType)]){
      switch ($entityType){
        case self::$ENTITY_ROUTE_MAPPER["EVENTS"]["TYPE"]:
          $entity = new entity\EventsEntity($this->db);
          break;
      }
    }
    
    return $entity;
  }
  
  /**
   *
   * EntityBuilder->getEntity($eventId)
   *
   * @return Entity $response;
   */
  public function getEntity ($entityType) {
    return $this->buildEntity($entityType);
  }
}
?>