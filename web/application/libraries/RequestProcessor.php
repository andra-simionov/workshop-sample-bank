<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class RequestProcessor
{
    /**
     * RequestProcessor constructor.
     */
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model('RequestValidatorModel');
        $this->ci->load->model('CardDataModel');
    }

    /**
     * @param string $email
     * @return int
     */
    public function processGetBalanceRequest($email)
    {
        return (int)$this->ci->CardDataModel->getUserBalanceByEmail($email);
    }
}
