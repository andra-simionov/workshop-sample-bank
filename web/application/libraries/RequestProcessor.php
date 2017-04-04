<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class RequestProcessor
{
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model('RequestValidatorModel');
        $this->ci->load->model('CardDataModel');
    }

    /**
     * @param string $email
     * @param int $requestAmount
     */
    public function processPayRequest($email, $requestAmount)
    {
        $originalAmount = $this->ci->CardDataModel->getUserSoldByEmail($email);
        $updatedAmount = $originalAmount - $requestAmount;

        $this->ci->RequestProcessorModel->updateSold($email, $updatedAmount);
    }

    public function processRefundRequest($email, $requestAmount)
    {
        $originalAmount = $this->ci->CardDataModel->getUserSoldByEmail($email);
        $updatedAmount = $originalAmount + $requestAmount;

        $this->ci->RequestProcessorModel->updateSold($email, $updatedAmount);
    }

    /**
     * @param string $email
     */
    public function processGetSoldRequest($email)
    {
        return $this->ci->CardDataModel->getUserSoldByEmail($email);
    }

    /**
     * @param string $email
     * @return array
     */
    public function processGetCardDataRequest($email)
    {
        $cardData = $this->ci->CardDataModel->getCardDataByEmail($email);

        return [
            'ExpirationDate' => $cardData['ExpirationMonth'] . '/' . $cardData['ExpirationYear'],
            'CardNumber' => $cardData['CardNumber'],
            'Cvv' => $cardData['Cvv']
        ];
    }
}
