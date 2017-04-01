<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require '../vendor/autoload.php';

use Slim\Http\Request;

class RequestProcessor
{
    public function processRequest(array $requestData)
    {
        $userEmail = $requestData['Email'];
        $requestAmount = $requestData['orderData']['amount'];
        $requestCurrency = $requestData['orderData']['currency'];

        if ($requestAmount > $this->UserProfileModel->getUserSoldByEmail($userEmail)) {
            throw new Exception('Insufficient funds!');
        }

        //TODO validare pentru currency

        $this->RequestProcessorModel->updateSold($userEmail, $requestAmount);
    }
}
