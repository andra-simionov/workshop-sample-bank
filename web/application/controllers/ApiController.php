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

    public function __construct()
    {
        parent::__construct();
        $this->load->library('RequestValidator');
        $this->load->library('RequestProcessor');
    }

    public function pay_post()
    {
        $postData = $this->post();

        try {
            $this->requestvalidator->validateRequestStructure($postData, requestvalidator::REQUIRED_PAY_REQUEST_KEYS);

            $email = $postData['email'];
            $token = $postData['token'];

            $this->checkApiAuthentication($this->head('Authorization'), $email, $token);

            $requestAmount = $postData['orderData']['amount'];
            $requestCurrency = $postData['orderData']['currency'];

            $this->requestvalidator->validateAmount($email, $requestAmount);
            $this->requestvalidator->validateCurrency($email, $requestCurrency);

            $this->requestprocessor->processPayRequest($email, $requestAmount);

            $apiResponse = $this->getApiMetaResponseForSuccess();

            $httpCode = self::SUCCESS_HTTP_CODE;

        } catch (Exception $e) {
            $apiResponse = $this->getApiMetaResponseForError($e->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;
        }

        $apiResponse['orderData']['reference'] = $postData['orderData']['reference'];
        $this->response($apiResponse, $httpCode);
    }

    public function refund_post()
    {
        $postData = $this->post();

        try {
            $this->requestvalidator->validateRequestStructure($postData, requestvalidator::REQUIRED_REFUND_REQUEST_KEYS);

            $email = $postData['email'];
            $token = $postData['token'];

            $this->checkApiAuthentication($this->head('Authorization'), $email, $token);

            $requestAmount = $postData['orderData']['amount'];
            $requestCurrency = $postData['orderData']['currency'];

            $this->requestvalidator->validateCurrency($email, $requestCurrency);

            $this->requestprocessor->processRefundRequest($email, $requestAmount);

            $apiResponse = $this->getApiMetaResponseForSuccess();

            $httpCode = self::SUCCESS_HTTP_CODE;

        } catch (Exception $e) {
            $apiResponse = $this->getApiMetaResponseForError($e->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;
        }

        $apiResponse['orderData']['reference'] = $postData['orderData']['reference'];
        $this->response($apiResponse, $httpCode);
    }

    public function balance_get()
    {
        $getData = $this->get();

        try {
            $this->requestvalidator->validateRequestStructure($getData, requestvalidator::REQUIRED_GET_BALANCE_REQUEST_KEYS);

            $email = $getData['email'];
            $token = $getData['token'];

            $this->checkApiAuthentication($this->head('Authorization'), $email, $token);

            $currentBalance = $this->requestprocessor->processGetBalanceRequest($email);

            $apiResponse = $this->getApiMetaResponseForSuccess();

            $apiResponse['userData']['balance'] = $currentBalance;
            $httpCode = self::SUCCESS_HTTP_CODE;

        } catch (Exception $e) {
            $apiResponse = $this->getApiMetaResponseForError($e->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;
        }
        $this->response($apiResponse, $httpCode);
    }

    public function cardData_get()
    {
        $getData = $this->get();

        try {
            $this->requestvalidator->validateRequestStructure($getData, requestvalidator::REQUIRED_GET_CARD_DATA_REQUEST_KEYS);

            $email = $getData['email'];
            $token = $getData['token'];

            $this->checkApiAuthentication($this->head('Authorization'), $email, $token);

            $cardData = $this->requestprocessor->processGetCardDataRequest($email);

            $apiResponse = $this->getApiMetaResponseForSuccess();
            $apiResponse['cardData'] = $cardData;
            $httpCode = self::SUCCESS_HTTP_CODE;

        } catch (Exception $e) {
            $apiResponse = $this->getApiMetaResponseForError($e->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;
        }

        $this->response($apiResponse, $httpCode);
    }

    /**
     * @param string $authorizationHeader
     * @param string $email
     */
    private function checkApiAuthentication($authorizationHeader, $email, $token)
    {
        $decryptedApiCredentials = base64_decode($authorizationHeader);
        $requestCredentials = explode(',', $decryptedApiCredentials);

        $authCredentials['StoreId'] = $requestCredentials[0];
        $authCredentials['SecretKey'] = $requestCredentials[1];

        $this->requestvalidator->validateRequestCredentials($email, $authCredentials, $token);
    }

    /**
     * @return array
     */
    private function getApiMetaResponseForSuccess()
    {
        $apiResponse['meta']['status'] = 'Ok';
        $apiResponse['meta']['message'] = 'Operation successful';

        return $apiResponse;
    }

    /**
     * @param string $errorMessage
     * @return array
     */
    private function getApiMetaResponseForError($errorMessage)
    {
        $apiResponse['meta']['status'] = 'Error';
        $apiResponse['meta']['message'] = $errorMessage;

        return $apiResponse;
    }
 }
