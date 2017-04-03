<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class RequestValidator
{
    private $ci;

    const REQUIRED_REQUEST_KEYS = [
        'timestamp',
        'requestId',
        'email',
        'orderData' => [
            'amount',
            'currency',
            'reference',
            ],
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

    /**
     * @param $email
     * @param $requestCredentials
     * @throws Exception
     */
    public function validateRequestCredentials($email, $requestCredentials)
    {
        $userCredentials = $this->ci->RequestValidatorModel->checkUserCredentials($requestCredentials);

        if (empty($userCredentials)) {
            throw new Exception('Authentication failed. Wrong user credentials.');
        } elseif ($email !== $userCredentials['Email']) {
            throw new Exception('Authentication failed. No user associated with the credentials.');
        }
    }

    /**
     * @param $email
     * @param $amount
     * @param $currency
     * @throws Exception
     */
    public function validateOrderData($email, $amount, $currency)
    {
        if ($amount > $this->ci->CardDataModel->getUserSoldByEmail($email)) {
            throw new Exception('Insufficient funds!');
        }

        if ($currency !== $this->ci->CardDataModel->getUserSoldCurrencyByEmail($email)) {
            throw new Exception('Currency not supported!');
        }
    }
}
