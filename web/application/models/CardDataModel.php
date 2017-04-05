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

        $idCreditCard = $this->getIdCardByIdUser($idUser);

        $data['ChangeDate'] = date('Y-m-d H:i:s');
        $this->db->where('IdCreditCard', $idCreditCard)
            ->update('credit_cards', $data);
    }

    /**
     * @param $idUser
     * @return int
     */
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

    /**
     * @param $email
     * @return int
     */
    public function getUserBalanceByEmail($email)
    {
        $result = $this->db->select(['Balance'])
            ->from('card_amounts')
            ->join('credit_cards', 'card_amounts.IdCreditCard=credit_cards.IdCreditCard')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.Email', $email)
            ->get()
            ->row_array();

        if (empty($result)) {
            return 0;
        }

        return $result['Balance'];
    }


    /**
     * @param string $email
     * @return array
     *
     * @throws Exception
     */
    public function getCardDataByEmail($email)
    {
        $result = $this->db->select(['CardNumber', 'Cvv', 'ExpirationYear', 'ExpirationMonth'])
            ->from('credit_cards')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.Email', $email)
            ->get()
            ->row_array();

        if (empty($result)) {
         //   throw new \Exception("Invalid email!");
            return ['CardNumber' => '', 'Cvv' => '', 'ExpirationYear' => '', 'ExpirationMonth' => ''];
        }

        return $result;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserBalanceCurrencyByEmail($email)
    {
        $result = $this->db->select(['Currency'])
            ->from('card_amounts')
            ->join('credit_cards', 'card_amounts.IdCreditCard=credit_cards.IdCreditCard')
            ->join('users', 'users.IdUser=credit_cards.IdUser')
            ->where('users.Email', $email)
            ->get()
            ->row_array();

        return $result['Currency'];
    }

    /**
     * @param $idUser
     * @return mixed
     */
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
