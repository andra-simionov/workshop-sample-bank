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
     * @param $email
     * @param $requestAmount
     */
    public function processPayRequest($email, $requestAmount)
    {
        $originalAmount = $this->ci->CardDataModel->getUserSoldByEmail($email);
        $updatedAmount = $originalAmount - $requestAmount;

        $this->ci->RequestProcessorModel->updateSold($email, $updatedAmount);
    }

    /**
     * @param $email
     */
    public function processGetSoldRequest($email)
    {
        $this->ci->CardDataModel->getUserSoldByEmail($email);
    }
}
