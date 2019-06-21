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

        // Validate if the GET request contains the required parameters
        try {
            $this->requestvalidator->validateRequestStructure($getData, requestvalidator::REQUIRED_GET_BALANCE_REQUEST_KEYS);
            $this->requestvalidator->validateRequestEmail($email);
            $this->requestvalidator->validateRequestToken($token, $email);

            $this->checkApiAuthentication($this->head('Authorization'), $email, $token);
        } catch (RequestValidatorException $e) {
            $apiResponse = $this->setApiMetaResponseForError($e->getMessage());
            $httpCode = self::ERROR_HTTP_CODE;

            $this->response($apiResponse, $httpCode);
        }


        // Retrieve balance data from database for a specific user, based on it's email
        $currentBalance = $this->requestprocessor->processGetBalanceRequest($email);

        // Set meta data + balance in the API response
        $apiResponse = $this->setBalanceApiResponseForSuccess($currentBalance);
        $httpCode = self::SUCCESS_HTTP_CODE;

        $this->response($apiResponse, $httpCode);
    }

    /**
     * @param int $currentBalance
     * @return array
     */
    private function setBalanceApiResponseForSuccess($currentBalance)
    {
        $apiResponse['meta']['status'] = 'Ok';
        $apiResponse['meta']['message'] = 'Operation successful';

        $apiResponse['userData']['balance'] = $currentBalance;

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

    /**
     * @param $authorizationHeader
     * @param $email
     * @param $token
     * @throws Exception
     */
    private function checkApiAuthentication($authorizationHeader, $email, $token)
    {
        if (isset($authorizationHeader)) {
            $decryptedApiCredentials = base64_decode($authorizationHeader);
            $requestCredentials = explode(',', $decryptedApiCredentials);

            $authCredentials['StoreId'] = $requestCredentials[0];
            $authCredentials['SecretKey'] = $requestCredentials[1];

            $this->requestvalidator->validateRequestCredentials($email, $authCredentials, $token);
        } else {
            throw new Exception("The 'Authorization' header is missing");
        }
    }
 }
