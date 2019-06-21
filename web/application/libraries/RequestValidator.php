<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'RequestValidatorException.php';

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
		$authCredentials = null;
		//TODO 2: call RequestValidatorModel, it might know something about $authCredentials


		if (empty($authCredentials)) {
            throw new RequestValidatorException('Authentication failed due to invalid user credentials');
        }
    }

	//TODO 7: add validations for currency and amount

    /**
     * @param string $authorizationHeader
     * @param string $email
     * @param string $token
     * @throws RequestValidatorException
     */
    public function checkApiAuthentication($authorizationHeader, $email, $token)
    {
        if (isset($authorizationHeader)) {
            $decryptedApiCredentials = base64_decode($authorizationHeader);
            $requestCredentials = explode(',', $decryptedApiCredentials);

            $authCredentials['StoreId'] = $requestCredentials[0];
            $authCredentials['SecretKey'] = $requestCredentials[1];

            //TODO 2: there's a method around here that can validate the credentials...

        } else {
            throw new RequestValidatorException("The 'Authorization' header is missing");
        }
    }
}
