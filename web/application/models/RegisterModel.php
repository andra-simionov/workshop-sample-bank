<?php

class RegisterModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $userData
     */
    public function registerUser(array $userData)
    {
        $this->db->insert('users', $userData);
    }
}
