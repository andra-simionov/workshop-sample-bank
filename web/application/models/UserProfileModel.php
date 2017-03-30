<?php

class UserProfileModel extends CI_Model
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

        $idCreditCard = $this->getIdCardByIdUser($idUser);

        $data['ChangeDate'] = date('Y-m-d H:i:s');
        $this->db->where('IdCreditCard', $idCreditCard)
            ->update('credit_cards', $data);
    }

    public function getUserCardNo($idUser)
    {
        $result = $this->db->select('*')
            ->from('credit_cards')
            ->join('users', 'users.IdUser = credit_cards.IdUser', 'inner')
            ->where('users.IdUser', $idUser)
            ->get()
            ->result_array();

        return count($result);
    }

    public function getUserCards($idUser)
    {
        $result = $this->db->select(['CardNumber', 'Cvv', 'ExpirationMonth', 'ExpirationYear'])
            ->from('credit_cards')
            ->where('IdUser', $idUser)
            ->get()
            ->result_array();

        $cardData = [];
        foreach ($result as $cardValue) {
            $cardData = $cardValue;
        }
        return $cardData;
    }

    public function getUserSold($idUser)
    {
        $result = $this->db->select(['Sold'])
            ->from('card_amounts')
            ->join('credit_cards', 'card_amounts.IdCreditCard=credit_cards.IdCreditCard')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.IdUser', $idUser)
            ->get()
            ->row_array();

        if (empty($result)) {
            return 0;
        }

        return $result['Sold'];
    }

    private function getIdCardByIdUser($idUser)
    {
        $idCard = $this->db->select('IdCreditCard')
            ->from('credit_cards')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.IdUser', $idUser)
            ->get()
            ->row_array();

        return $idCard['IdCreditCard'];
    }
}
