<?php

class UserProfileModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserCardNo($username)
    {
        $result = $this->db->select('*')
            ->from('credit_cards')
            ->join('users', 'users.IdUser = credit_cards.IdUser', 'inner')
            ->where('users.Username', $username)
            ->get()
            ->result_array();

        return count($result);
    }

    public function addCardData($data)
    {
        $this->db->insert('credit_cards', $data);
    }
}
