<?php

class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isUserRegistred(array $data)
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

    public function getUserIdByUserName($username)
    {
         $result = $this->db->select('IdUser')
             ->from('users')
             ->where('Username', $username)
             ->get()
             ->row_array();

         return $result['IdUser'];
    }
}
