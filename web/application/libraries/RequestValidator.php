<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require '../vendor/autoload.php';

use Slim\Http\Request;

class RequestValidator
{
    public function validateRequestCredentials($email, array $userCredentials)
    {
        $userCredentials = explode($userCredentials, ',');

        $userCredentialsArray['Email'] = $email;
        $userCredentialsArray['ClientId'] = $userCredentials[0];
        $userCredentialsArray['SecretKey'] = $userCredentials[1];

        if (empty($this->RequestValidatorModel->checkUserCredentials($userCredentialsArray))) {
            throw new Exception('There is no user associated with the request credentials');
        }
    }
}
