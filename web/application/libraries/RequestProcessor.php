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
     */
    public function processGetBalanceRequest($email)
    {
        return $this->ci->CardDataModel->getUserBalanceByEmail($email);
    }
}
