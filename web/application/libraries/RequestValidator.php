<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class RequestValidator
{
    private $ci;

    const REQUIRED_GET_BALANCE_REQUEST_KEYS = [
        'timestamp',
        'requestId',
        'email',
        'token',
    ];

    /**
     * RequestValidator constructor.
     */
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model('RequestValidatorModel');
        $this->ci->load->model('CardDataModel');
    }

    /**
     * @param array $requestData
     * @param array $format
     * @throws RequestValidatorException
     */
    public function validateRequestStructure(array $requestData, array $format)
    {
        foreach ($format as $key => $value) {
            if (is_numeric($key)) {
                $key = $value;
            }

            if (is_array($value)) {
                $this->validateRequestStructure($requestData[$key], $value);
            }

            if (!isset($requestData[$key])) {
                throw new RequestValidatorException("Parameter '$value' is missing");
            }
        }
    }

    /**
     * @param $email
     * @throws Exception
     */
    public function validateRequestEmail($email)
    {
        if (empty($this->ci->RequestValidatorModel->checkUserEmail($email))) {
            throw new Exception("No user associated with the sent email");
        }
    }

    /**
     * @param $token
     * @throws Exception
     */
    public function validateRequestToken($token, $email)
    {
        if (empty($this->ci->RequestValidatorModel->checkUserToken($token, $email))) {
            throw new Exception("No user associated with the sent token");
        }
    }
}
