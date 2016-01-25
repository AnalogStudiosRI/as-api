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
 * @class PostsResource
 *
 * @since 0.4.0
 *
 * @copyright 2016
 *
 */
class PostsResource extends base\AbstractRestfulResource{
  private $name = "posts";
  private $tableName = "posts";
  private $createParams = array("title", "summary", "createdTime");
  private $updateParams = array("title", "summary");

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
  public function getPosts(){
    $result = $this->db->select($this->tableName);
    $result["data"] = $this->modelDatabaseResult($result["data"]);

    return $result;
  }

  public function getPostById($id = null){
    $result = $this->db->select($this->tableName, $id);
    $result["data"] = $this->modelDatabaseResult($result["data"]);

    return $result;
  }

  public function createPost($params = array()){
    $params["createdTime"] = time();
    $result = $this->db->insert($this->tableName, $this->createParams, $params);

    return $result;
  }

  public function updatePost($id = null, $params = array()){
    $result = $this->db->update($this->tableName, $id, $this->updateParams, $params);

    return $result;
  }

  public function deletePost($id = null){
    $result = $this->db->delete($this->tableName, $id);

    return $result;
  }
}
