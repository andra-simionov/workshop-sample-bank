<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class RequestProcessor
{
    /**
     * @param $email
     * @param $requestAmount
     */
    public function processRequest($email, $requestAmount)
    {
        $ci = & get_instance();
        $ci->load->model('RequestProcessorModel');
        $ci->load->model('CardDataModel');

        $originalAmount = $ci->CardDataModel->getUserSoldByEmail($email);
        $updatedAmount = $originalAmount - $requestAmount;

        $ci->RequestProcessorModel->updateSold($email, $updatedAmount);
    }
}
