<?php

namespace resources;

use base as base;


/**
 *
 * @author Owen Buckley
 * @email owen@analogstudios.net
 * @api as-api
 * @package resources
 * @uses base base
 * @class ArtistsResource
 *
 * @since 0.5.0
 *
 * @copyright 2016
 *
 */
class ArtistsResource extends base\AbstractRestfulResource{
  private $name = "artists";
  private $tableName = "artists";
  private $createParams = array("name", "bio");
  private $updateParams = array("name", "imageUrl", "genre", "location", "label", "contactPhone", "contactEmail", "bio", "isActive");

  private function modelDatabaseResult ($data){
    $model = array();

    for($i = 0, $l = count($data); $i < $l; $i++){
      $d = $data[$i];
      $model[$i] = $d;

      $model[$i]["createdTime"] = (int) $d["createdTime"];
    }

    return $model;
  }

  //abstract getters
  public function getName(){
    return $this->name;
  }

  public function getTableName(){
    return $this->tableName;
  }

  public function getRequiredCreateParams(){
    return $this->createParams;
  }

  public function getAllowedUpdateParams(){
    return $this->updateParams;
  }

  //resource level methods
  public function getArtists(){
    return $this->db->select($this->tableName);
  }

  public function getArtistById($id = null){
    return $this->db->select($this->tableName, $id);
  }

  public function createArtist($params = array()){
    return $this->db->insert($this->tableName, $this->createParams, $params);
  }

  public function updateArtist($id = null, $params = array()){
    return $this->db->update($this->tableName, $id, $this->updateParams, $params);
  }

  public function deleteArtist($id = null){
    return $this->db->delete($this->tableName, $id);
  }
}
