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

    public function balance_get()
    {
        $getData = $this->get();

        try {
            $this->requestvalidator->validateRequestStructure($getData, requestvalidator::REQUIRED_GET_BALANCE_REQUEST_KEYS);

            $email = $getData['email'];

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
