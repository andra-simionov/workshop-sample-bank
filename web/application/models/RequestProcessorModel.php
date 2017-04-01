<?php

class RequestProcessorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $email
     * @param $amount
     * @return bool
     */
    public function updateSold($email, $amount)
    {
        $idCard = $this->getIdCardByEmail($email);

        $this->db->where('IdCreditCard', $idCard)
            ->update('card_amounts', ['Sold' => $amount]);

        return $this->db->affected_rows() > 0;
    }

    /**
     * @param $email
     * @return mixed
     */
    private function getIdCardByEmail($email)
    {
        $idCard = $this->db->select('IdCreditCard')
            ->from('credit_cards')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.Email', $email)
            ->get()
            ->row_array();

        return $idCard['IdCreditCard'];
    }
}
