<?php

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

    /**
     *
     */
    public function sold_post()
    {
        $postData = $this->post();
        $apiResponse['orderData']['reference'] = $postData('orderData')['reference'];

        try {
            $this->requestvalidator->validateRequestStructure(requestvalidator::REQUIRED_REQUEST_KEYS);

            $email = $postData['email'];

            $requestCredentials = explode(',', $this->head('Authorization'));
            $authCredentials['ClientId'] = $requestCredentials[0];
            $authCredentials['SecretKey'] = $requestCredentials[1];

            $requestAmount = $postData('orderData')['amount'];
            $requestCurrency = $postData('orderData')['currency'];

            $this->requestvalidator->validateRequestCredentials($email, $authCredentials);
            $this->requestvalidator->validateOrderData($email, $requestAmount, $requestCurrency);

            $this->requestprocessor->processRequest($email, $requestAmount);

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
 }
