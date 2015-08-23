<?php

namespace services;

/**
 *
 * @author Owen Buckley
 * @email owen@analogstudios.net
 * @api as-api
 * @package services
 * @class ContactService
 *
 * @since 0.3.0
 *
 * @copyright 2015
 *
 */
class ContactService {

  public static function sendEmail($to = "", $from = "", $subject = "", $message = ""){
    $error = false;
    $status = 200;
    $errorMessage = "";

    if($to === "" || !filter_var($to, FILTER_VALIDATE_EMAIL)){
      $error = true;
      $errorMessage = "Invalid to email address";
    }

    if(!$error && ($from === "" || !filter_var($from, FILTER_VALIDATE_EMAIL))){
      $error = true;
      $errorMessage = "Invalid from email address";
    }

    if(!$error && $subject === ""){
      $error = true;
      $errorMessage = "No subject";
    }

    if(!$error && $message === ""){
      $error = true;
      $errorMessage = "No message";
    }

    if(!$error){
      $message = wordwrap($message, 70, "\r\n");

      if(mail($to, $subject, $message)){
        $errorMessage = "Message sent";
      } else {
        $errorMessage = "Couldn't send mail";
        $status = 500;
      }
    }else{
      $status = 400;
    }

    return array(
      "status" => $status,
      "message" => $errorMessage
    );

  }
}