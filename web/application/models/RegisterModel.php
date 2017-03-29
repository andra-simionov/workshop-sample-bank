<?php

class RegisterModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @return bool
     */
    public function registerUser($username, $password, $email)
    {
        $userData = [
            'Username' => $username,
            'Password' => $password,
            'Email' => $email,
            ];

        $this->db->insert('users', $userData);
    }
}
