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

  private $db;
  private $config;

  //XXX TODO should have config service injected
  //XXX TODO should have JWT Service injected
  public function __construct($config){
    $this->config = $config;
    $this->db = new \PDO($this->config["db"]["dsn"], $this->config["db"]["username"], $this->config["db"]["password"]);
  }

  private function generateJWT ($id, $username) {
    $tokenId    = base64_encode(mcrypt_create_iv(32));
    $issuedAt   = time();
    $notBefore  = $issuedAt + 10;                     //Adding 10 seconds
    $expire     = $notBefore + 60;                    // Adding 60 seconds
    $serverName = $this->config["session"]["domain"];  // Retrieve the server name from config file

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

    //XXX TODO THIS SHOULD NOT BE HARDCODED!!!!
    $secretKey = base64_decode("jwtKey");

    /*
     * Encode the array to a JWT string.
     * Second parameter is the key to encode the token.
     *
     * The output string can be validated at http://jwt.io/
     */
    $jwt = JWT::encode(
      $jwtData,       //Data to be encoded in the JWT
      $secretKey,     // The signing key
      "HS512"         // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
    );

    $unencodedArray = ["jwt" => $jwt];
    //echo json_encode($unencodedArray);

    return $unencodedArray;
  }

  public function login ($username = null, $password = null) {
    $response = array("success" => false, "message" => "");

    if(is_string($username) && is_string($password)){
      $db = $this->db;

      $stmt = $db->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
      $stmt->bindValue(":username", $username);
      $stmt->bindValue(":password", $password);
      $stmt->execute();

      $result = $stmt->fetchAll($db::FETCH_ASSOC);

      if(count($result) === 1){
        $response["success"] = true;
        $response["message"] = "Login Success";
        $response["data"] = $this->generateJWT($result[0]["id"], $username);
      }else{
        $response["message"] = "Invalid Credentials";
      }
    }else{
      throw new \InvalidArgumentException("Messing Credentials");
    }

    return $response;
  }

}