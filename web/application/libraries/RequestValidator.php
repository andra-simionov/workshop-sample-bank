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

    public function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model('RequestValidatorModel');
        $this->ci->load->model('CardDataModel');
    }

    /**
     * @param array $requestData
     * @param $format
     * @throws Exception
     */
    public function validateRequestStructure(array $requestData, $format)
    {
        foreach ($format as $key => $value) {
            if (is_numeric($key)) {
                $key = $value;
            }

            if (is_array($value)) {
                $this->validateRequestStructure($requestData[$key], $value);
            }

            if (!isset($requestData[$key])) {
                throw new Exception("Parameter '$value' is missing");
            }
        }
    }
}
