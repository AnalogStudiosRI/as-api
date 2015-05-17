<?php

error_reporting(E_ALL | E_STRICT);

require_once "src/encrypt/EncryptDecrypt.php";

use encrypt as encrypt;

/**
 *
 * name: EncryptDecryptTest
 *
 * @author Owen Buckley
 */


class EncryptDecryptTest extends PHPUnit_Framework_TestCase {
  private $encryptDecrypt = null;

  public function setup(){
    $this->encryptDecrypt = new encrypt\EncryptDecrypt('./token.txt');
  }

  public function tearDown(){
    $this->encryptDecrypt = null;
  }

  public function testEncryptDecryptSuccess(){
    $dataPlain = 'Owen Buckley';
    $dataEncrypted = 'XQ9DKbW6oKbOk5DhPGabZ5g1iO8twqfmU8kVuzfYMbs=';

    $encrypted =  $this->encryptDecrypt->encryptData($dataPlain);
    $decrypted = $this->encryptDecrypt->decryptData($encrypted);

    $this->assertEquals($dataEncrypted, $encrypted);
    $this->assertEquals($dataPlain, $decrypted);
  }

}





