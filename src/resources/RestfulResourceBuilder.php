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
   * @return RestfulResource
   */
  private function buildResource(){
    $entity = NULL;

    switch (strtolower($this->entityType)){
      case 'events':
        $entity = new EventsResource($this->db);
        break;
      default:
        //throw exception
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