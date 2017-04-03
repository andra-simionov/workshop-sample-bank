<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Restserver\Libraries\REST_Controller;

require(APPPATH . 'libraries/REST_Controller.php');

class SoldController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('RequestValidator');
        $this->load->library('RequestProcessor');
    }

    public function pay_post()
    {
        $postData = $this->post();
        $apiResponse['orderData']['reference'] = $postData['orderData']['reference'];

        try {
            $this->requestvalidator->validateRequestStructure($postData, requestvalidator::REQUIRED_PAY_REQUEST_KEYS);

            $email = $postData['email'];

            $requestCredentials = explode(',', $this->head('Authorization'));
            $authCredentials['ClientId'] = $requestCredentials[0];
            $authCredentials['SecretKey'] = $requestCredentials[1];

            $this->requestvalidator->validateRequestCredentials($email, $authCredentials);

            $requestAmount = $postData['orderData']['amount'];
            $requestCurrency = $postData['orderData']['currency'];

            $this->requestvalidator->validateOrderData($email, $requestAmount, $requestCurrency);

            $this->requestprocessor->processPayRequest($email, $requestAmount);

            $apiResponse['meta']['status'] = 'Ok';
            $apiResponse['meta']['message'] = 'Operation successful';
            $httpCode = 200;

        } catch (Exception $e) {
            $apiResponse['meta']['status'] = 'Error';
            $apiResponse['meta']['message'] = $e->getMessage();
            $httpCode = 400;
        }

        $this->response($apiResponse, $httpCode);
    }

    public function getSold_get()
    {
        $getData = $this->get();

        try {
            $this->requestvalidator->validateRequestStructure($getData, requestvalidator::REQUIRED_GET_SOLD_REQUEST_KEYS);

            $email = $getData['email'];

            $requestCredentials = explode(',', $this->head('Authorization'));
            $authCredentials['ClientId'] = $requestCredentials[0];
            $authCredentials['SecretKey'] = $requestCredentials[1];

            $this->requestvalidator->validateRequestCredentials($email, $authCredentials);

            $currentSold = $this->requestprocessor->processGetSoldRequest($email);

            $apiResponse['meta']['status'] = 'Ok';
            $apiResponse['meta']['message'] = 'Operation successful';
            $apiResponse['userData']['sold'] = $currentSold;
            $httpCode = 200;

        } catch (Exception $e) {
            $apiResponse['meta']['status'] = 'Error';
            $apiResponse['meta']['message'] = $e->getMessage();
            $httpCode = 400;
        }
        $this->response($apiResponse, $httpCode);
    }
 }
