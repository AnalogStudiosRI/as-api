<?php 

namespace net\analogstudios\builders;

use \net\analogstudios\models as models;
use \net\analogstudios\core as core;


date_default_timezone_set("America/New_York");

/**
 * name: EventsController
 * namespace: net\analogstudios\controllers
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
  function __construct(core\Database $db) {
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
          $entity = new models\EventsModel($this->db);
          break;
      }
    }
    
    return $entity;
  }
  
  /**
   *
   * EventsController->get($eventId)
   *
   * @return array $response;
   */
  public function getEntity ($entityType) {
    return $this->buildEntity($entityType);
  }
}
?>