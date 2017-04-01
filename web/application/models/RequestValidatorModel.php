<?php

class RequestValidatorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $userCredentials
     * @return int
     */
    public function checkUserCredentials(array $userCredentials)
    {
        $result = $this->db->select('*')
            ->from('user_credentials')
            ->where($userCredentials)
            ->get()
            ->row_array();

        return $result;
    }
}
