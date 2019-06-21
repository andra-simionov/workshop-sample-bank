<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Restserver\Libraries\REST_Controller;

require(APPPATH . 'libraries/REST_Controller.php');

class ApiController extends REST_Controller
{
    const SUCCESS_HTTP_CODE = "200";
    const ERROR_HTTP_CODE = "400";

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('RequestValidator');
        $this->load->library('RequestProcessor');
    }

    public function balance_get()
    {
        $getData = $this->get();
        $token = $getData['token'];
        $email = $getData['email'];

        try {
            // Validate if the GET request contains the required parameters
            $this->requestvalidator->validateRequestStructure($getData, requestvalidator::REQUIRED_GET_BALANCE_REQUEST_KEYS);
            $this->requestvalidator->validateRequestEmail($email);
            $this->requestvalidator->validateRequestToken($token, $email);

            // Validate that the 'Authorization' header for API authentication is set correctly
            $this->requestvalidator->checkApiAuthentication($this->head('Authorization'), $email, $token);

            // Retrieve balance data from database for a specific user, based on its email
            $currentBalance = $this->requestprocessor->processGetBalanceRequest($email);

            // Set meta data + balance in the API response
            $apiResponse = $this->setApiMetaResponseForSuccess();
            $apiResponse['userData']['balance'] = $currentBalance;

            $httpCode = self::SUCCESS_HTTP_CODE;

        } catch (RequestValidatorException $exception) {
            $apiResponse = $this->setApiMetaResponseForError($exception->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;
        }

        $this->response($apiResponse, $httpCode);
    }

    public function pay_post()
    {
        $postData = $this->post();
        $email = $postData['email'];
        $requestAmount = (int)$postData['orderData']['amount'];
        $token = $postData['token'];
        $requestCurrency = $postData['orderData']['currency'];

        try {
            // Validate if the POST request contains the required parameters
            $this->requestvalidator->validateRequestStructure($postData, requestvalidator::REQUIRED_PAY_REQUEST_KEYS);
            $this->requestvalidator->validateRequestEmail($email);
            $this->requestvalidator->validateRequestToken($token, $email);
            $this->requestvalidator->validateAmount($email, $requestAmount);
            $this->requestvalidator->validateCurrency($email, $requestCurrency);

            // Validate that the 'Authorization' header for API authentication is set correctly
            $this->requestvalidator->checkApiAuthentication($this->head('Authorization'), $email, $token);

            // Update the balance of the user based on its email
            $this->requestprocessor->processPayRequest($email, $requestAmount);

            // Set meta data in the API response
            $apiResponse = $this->setApiMetaResponseForSuccess();

            $httpCode = self::SUCCESS_HTTP_CODE;

        } catch (RequestValidatorException $exception) {
            $apiResponse = $this->setApiMetaResponseForError($exception->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;
        }

        // Use the same reference sent in the request to match the response of the API
        $apiResponse['orderData']['reference'] = $postData['orderData']['reference'];
        $this->response($apiResponse, $httpCode);
    }

    public function refund_post()
    {
        $postData = $this->post();
        $email = $postData['email'];
        $token = $postData['token'];

        try {
            $this->requestvalidator->validateRequestStructure($postData, requestvalidator::REQUIRED_REFUND_REQUEST_KEYS);
            $this->requestvalidator->checkApiAuthentication($this->head('Authorization'), $email, $token);

            $requestAmount = $postData['orderData']['amount'];
            $requestCurrency = $postData['orderData']['currency'];

            $this->requestvalidator->validateCurrency($email, $requestCurrency);

            $this->requestprocessor->processRefundRequest($email, $requestAmount);

            $apiResponse = $this->setApiMetaResponseForSuccess();

            $httpCode = self::SUCCESS_HTTP_CODE;

        } catch (RequestValidatorException $e) {
            $apiResponse = $this->setApiMetaResponseForError($e->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;
        }

        // Use the same reference sent in the request to match the response of the API
        $apiResponse['orderData']['reference'] = $postData['orderData']['reference'];
        $this->response($apiResponse, $httpCode);
    }

    /**
     * @return array
     */
    private function setApiMetaResponseForSuccess()
    {
        $apiResponse['meta']['status'] = 'Ok';
        $apiResponse['meta']['message'] = 'Operation successful';

        return $apiResponse;
    }

    /**
     * @param string $errorMessage
     * @return array
     */
    private function setApiMetaResponseForError($errorMessage)
    {
        $apiResponse['meta']['status'] = 'Error';
        $apiResponse['meta']['message'] = $errorMessage;

        return $apiResponse;
    }

 }
