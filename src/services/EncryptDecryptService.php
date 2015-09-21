<?php

namespace services;

/**
 *
 * @author Owen Buckley
 * @email owen@analogstudios.net
 * @api as-api
 * @package services
 * @class EncryptDecrypt
 *
 * @since 0.3.0
 *
 * @copyright 2015
 *
 */

class EncryptDecryptService {
  private $token = '';

  function __construct($tokenPath = ''){
    if($tokenPath !== '' && file_exists($tokenPath)){
      $this->token = file_get_contents($tokenPath);
    }else{
      throw new \InvalidArgumentException('Invalid Constructor Params');
    }
  }

  public function encryptData($data = ''){
    if($data !== '') {
      return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->token), $data, MCRYPT_MODE_CBC, md5(md5($this->token))));
    }else{
      throw new \InvalidArgumentException('Invalid Method Param');
    }
  }

  public function decryptData($data = ''){
    if($data !== '') {
      return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->token), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($this->token))), "\0");
    }else{
      throw new \InvalidArgumentException('Invalid Method Param');
    }
  }

}