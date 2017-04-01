<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RequestValidator
{
    public function validateRequestCredentials($email, $clientId, $secretKey)
    {
        $CI = & get_instance();
        $CI->load->model('RequestValidatorModel');

        if (empty($CI->RequestValidatorModel->checkUserCredentials($email, $clientId, $secretKey))) {
            throw new Exception('There is no user associated with the request credentials');
        }
    }
}
