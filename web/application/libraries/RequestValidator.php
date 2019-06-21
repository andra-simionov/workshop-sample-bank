<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class RequestValidator
{
    private $ci;

    const REQUIRED_PAY_REQUEST_KEYS = [
        'timestamp',
        'requestId',
        'email',
        'token',
        'orderData' => [
            'amount',
            'currency',
            'reference',
        ],
    ];

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
     * @param string $email
     * @throws RequestValidatorException
     */
    public function validateRequestEmail($email)
    {
        if (empty($this->ci->RequestValidatorModel->checkUserEmail($email))) {
            throw new RequestValidatorException("No user associated with the sent email");
        }
    }

    /**
     * @param string $token
     * @param string $email
     * @throws RequestValidatorException
     */
    public function validateRequestToken($token, $email)
    {
        if (empty($this->ci->RequestValidatorModel->checkUserToken($token, $email))) {
            throw new RequestValidatorException("No user associated with the sent token");
        }
    }

    /**
     * @param string $email
     * @param array $requestCredentials
     * @param string $token
     * @throws RequestValidatorException
     */
    public function validateRequestCredentials($email, $requestCredentials, $token)
    {
        $authCredentials = $this->ci->RequestValidatorModel->checkUserCredentials($email, $requestCredentials, $token);

        if (empty($authCredentials)) {
            throw new RequestValidatorException('Authentication failed due to invalid user credentials');
        }
    }

    /**
     * @param string $email
     * @param int $amount
     * @throws RequestValidatorException
     */
    public function validateAmount($email, $amount)
    {
        if ($amount > $this->ci->CardDataModel->getUserBalanceByEmail($email)) {
            throw new RequestValidatorException('Insufficient funds!');
        }
    }

    /**
     * @param string $email
     * @param string $currency
     * @throws RequestValidatorException
     */
    public function validateCurrency($email, $currency)
    {
        if ($currency !== $this->ci->CardDataModel->getUserBalanceCurrencyByEmail($email)) {
            throw new RequestValidatorException('Currency not supported!');
        }
    }
}
