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
    public function checkUserCredentials($email, $clientId, $secretKey)
    {
        $result = $this->db->select('*')
            ->from('user_credentials')
            ->where(['Email' => $email, 'ClientId' => $clientId, 'SecretKey' => $secretKey])
            ->get()
            ->row_array();

        return $result;
    }
}
