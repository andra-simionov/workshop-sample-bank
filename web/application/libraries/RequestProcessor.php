<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RequestProcessor
{
    public function processRequest(array $requestData)
    {
        $CI = & get_instance();
        $CI->load->model('RequestProcessorModel');
        $CI->load->model('UserProfileModel');

        $userEmail = $requestData['Email'];
        $requestAmount = $requestData['Amount'];
        $requestCurrency = $requestData['Currency'];

        if ($requestAmount > $CI->UserProfileModel->getUserSoldByEmail($userEmail)) {
            throw new Exception('Insufficient funds!');
        }

        //TODO validare pentru currency

        $CI->RequestProcessorModel->updateSold($userEmail, $requestAmount);
    }
}
