<?php

class RequestProcessorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //TODO 6: we might need here a method to update the balance

    /**
     * @param string $email
     * @return int
     */
    private function getIdCardByEmail($email)
    {
        $idCard = $this->db->select('IdCreditCard')
            ->from('credit_cards')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.Email', $email)
            ->get()
            ->row_array();

        return (int)$idCard['IdCreditCard'];
    }
}
