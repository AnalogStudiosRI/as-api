<?php

namespace services;

/**
 *
 * @author Owen Buckley
 * @email owen@analogstudios.net
 * @api as-api
 * @package services
 * @class AuthenticationService
 *
 * @since 0.3.0
 *
 * @copyright 2015
 *
 */

use \Firebase\JWT\JWT;

class AuthenticationService{
  private static $JWT_NOT_BEFORE_OFFEST = 10;   //Adding 10 seconds
  private static $JWT_EXPIRE_OFFEST = 60;       //Adding 70 seconds
  private static $JWT_ALGORITHM = "HS512";      //https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
  private $db;
  private $config;

  //XXX TODO should have config service injected
  //XXX TODO should have JWT Service injected
  public function __construct($config){
    $this->config = $config;
    $this->db = new \PDO(
      "mysql:host=" . $this->config['db.host'] . ";dbname=" . $this->config['db.name'],
      $this->config["db.user"],
      $this->config["db.password"]
    );
  }

  private function generateJWT ($id, $username) {
    $tokenId = base64_encode(mcrypt_create_iv(32));
    $issuedAt = time();
    $notBefore = $issuedAt + self::$JWT_NOT_BEFORE_OFFEST;
    $expire = $notBefore + self::$JWT_EXPIRE_OFFEST;
    $serverName = $this->config["session.domain"];
    $secretKey = $this->config["key.jwtSecret"];

    /*
     * Create the token as an array
     */
    $jwtData = array(
      "iat"  => $issuedAt,          // Issued at: time when the token was generated
      "jti"  => $tokenId,           // Json Token Id: an unique identifier for the token
      "iss"  => $serverName,        // Issuer
      "nbf"  => $notBefore,         // Not before
      "exp"  => $expire,            // Expire
      "data" => [                   // Data related to the signer user
        "userId"   => $id,          // userid from the users table
        "userName" => $username,    // User name
      ]
    );

    /*
     * Encode the array to a JWT string.
     * Second parameter is the key to encode the token.
     *
     * The output string can be validated at http://jwt.io/
     */
    $jwt = JWT::encode(
      $jwtData,               //Data to be encoded in the JWT
      $secretKey,             // The signing key
      self::$JWT_ALGORITHM    // Algorithm used to sign the token
    );

    return array("jwt" => $jwt);
  }

  private function validateJWT ($token){
    $isValid = false;

    if(is_string($token)){

      try{
        JWT::decode($token, $this->config["key.jwtSecret"], array(self::$JWT_ALGORITHM));

        $isValid = true;
      }catch(\Firebase\JWT\BeforeValidException $e){
        throw new \Firebase\JWT\BeforeValidException("Before Valid Time");
      }
    }else{
      throw new \InvalidArgumentException("Missing Token");
    }

    return $isValid;
  }

  private function validateCredentials ($username, $password){
    $db = $this->db;

    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":password", $password);
    $stmt->execute();

    return $stmt->fetchAll($db::FETCH_ASSOC);
  }

  /*
   * Used when a user logs in for the first time
   */
  public function login ($username = null, $password = null) {
    $response = array("success" => false, "message" => "", "data" => "");

    if(is_string($username) && is_string($password)){
      $result = $this->validateCredentials($username, $password);

      if(count($result) === 1){
        $response["success"] = true;
        $response["message"] = "Login Success";
        $response["data"] = $this->generateJWT($result[0]["id"], $username);
      }else{
        $response["message"] = "Invalid Credentials";
      }
    }else{
      $response["message"] = "Missing Credentials";
    }

    return $response;
  }

  /*
   * Used when a user is requested protected resources and existing login needs to be validated
   */
  public function validateLogin ($token = null){
    $isValid = false;

    if(is_string($token)){
      $isValid = $this->validateJWT($token);
    }

    return $isValid;
  }

}