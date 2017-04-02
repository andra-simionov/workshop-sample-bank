<?php

class UserDataModel extends CI_Model
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

    /**
     * @param array $data
     * @return bool
     */
    public function isUserRegistered(array $data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $result = $this->db->select('*')
            ->from('users')
            ->where(['Username' => $username, 'Password' => $password])
            ->get()
            ->result_array();

        if (count($result) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getUserInfo(array $data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $result = $this->db->select('*')
            ->from('users')
            ->where(['Username' => $username, 'Password' => $password])
            ->get()
            ->result_array();

        return $result;
    }

    public function getUserIdByUsername($username)
    {
        $result = $this->db->select('IdUser')
            ->from('users')
            ->where('Username', $username)
            ->get()
            ->row_array();

        return $result['IdUser'];
    }
}
