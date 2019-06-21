<?php

class CardDataModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addCardData(array $data, $idUser)
    {
        if ($this->getUserCardNo($idUser) == 0) {
            $data['AddDate'] = date('Y-m-d H:i:s');
            $this->db->insert('credit_cards', $data);
        }

        return $this->db->insert_id();
    }

    /**
     * @param int $idCard
     */
    public function addSoldForCreditCard($idCard)
    {
        $data = [
            'IdCreditCard' => (int)$idCard,
            'Balance' => 6000,
            'AddDate' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('card_amounts', $data);
    }

    /**
     * @param int $idUser
     * @return int
     */
    public function getUserCardNo($idUser)
    {
        $result = $this->db->select('*')
            ->from('credit_cards')
            ->join('users', 'users.IdUser = credit_cards.IdUser', 'inner')
            ->where('users.IdUser', (int)$idUser)
            ->get()
            ->result_array();

        return count($result);
    }

    /**
     * @param int $idUser
     * @return array
     */
    public function getUserCards($idUser)
    {
        $result = $this->db->select(['CardNumber', 'Cvv', 'ExpirationMonth', 'ExpirationYear'])
            ->from('credit_cards')
            ->where('IdUser', (int)$idUser)
            ->get()
            ->result_array();

        $cardData = [];
        foreach ($result as $cardValue) {
            $cardData = $cardValue;
        }
        return $cardData;
    }

    /**
     * @param string $email
     * @return int
     */
    public function getUserBalanceByEmail($email)
    {
        $result = $this->db->select(['Balance'])
            ->from('card_amounts')
            ->join('credit_cards', 'card_amounts.IdCreditCard=credit_cards.IdCreditCard')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.Email', (string)$email)
            ->get()
            ->row_array();

        if (empty($result)) {
            return 0;
        }

        return (int)$result['Balance'];
    }

    /**
     * @param string $email
     * @return string
     */
    public function getUserBalanceCurrencyByEmail($email)
    {
        //TODO 7: read user's currency from database

        return '';
    }

}
