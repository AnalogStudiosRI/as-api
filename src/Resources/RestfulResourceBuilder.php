<?php

namespace resources;

use dao as dao;

 /**
  *
  * @author Owen Buckley
  * @email owen@analogstudios.net
  * @api as-api
  * @package resources
  * @uses base base
  * @class RestfulResourceBuilder
  *
  * @since 0.3.0
  *
  * @copyright 2014
  *
  */
class RestfulResourceBuilder {
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
      $this->db = new dao\RestfulDatabase($dbConfig);
    }else{
      throw new \InvalidArgumentException('Invalid Constructor Params');
    }
  }

  /**
   *
   * @method buildEntity
   *
   * @return RestfulEntity RestfulEntity model
   */
  private function buildResource(){
    $entity = NULL;

    if(self::$ENTITY_ROUTE_MAPPER[strtoupper($this->entityType)]){
      switch ($this->entityType){
        case self::$ENTITY_ROUTE_MAPPER["EVENTS"]["TYPE"]:
          $entity = new EventResource($this->db);
          break;
      }
    }

    return $entity;
  }

  /**
   *
   * @method getResource
   *
   * @return RestfulResource;
   */
  public function getResource () {
    return $this->buildResource();
  }
}
?>