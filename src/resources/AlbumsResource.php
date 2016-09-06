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
 * @class AlbumsResource
 *
 * @since 0.5.0
 *
 * @copyright 2016
 *
 */
class AlbumsResource extends base\AbstractRestfulResource{
  private $name = "albums";
  private $tableName = "albums";
  private $requiredParams = array("title", "description", "artistId");
  private $updateParams = array("title", "description", "imageUrl", "downloadUrl", "year");
  private $optionalParams = array("year", "imageUrl", "downloadUrl");

  //abstract getters
  public function getName(){
    return $this->name;
  }

  public function getTableName(){
    return $this->tableName;
  }

  public function getRequiredCreateParams(){
    return $this->requiredParams;
  }

  public function getAllowedUpdateParams(){
    return $this->updateParams;
  }

  //resource level methods
  public function getAlbums(){
    return $this->db->select($this->tableName);
  }

  public function getAlbumById($id = null){
    return $this->db->select($this->tableName, $id);
  }

  public function createAlbum($params = array()){
    return $this->db->insert($this->tableName, $this->getRequiredCreateParams(), $params, $this->optionalParams);
  }

  public function updateAlbum($id = null, $params = array()){
    return $this->db->update($this->tableName, $id, $this->getAllowedUpdateParams(), $params);
  }

  public function deleteAlbum($id = null){
    return $this->db->delete($this->tableName, $id);
  }
}
