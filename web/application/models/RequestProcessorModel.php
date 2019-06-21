<?php

class RequestProcessorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $email
     * @param int $amount
     * @return bool
     */
    public function updateBalance($email, $amount)
    {
        $idCard = (int)$this->getIdCardByEmail($email);

        $this->db->where('IdCreditCard', $idCard)
            ->update('card_amounts', ['Balance' => $amount]);

        return $this->db->affected_rows() > 0;
    }

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
