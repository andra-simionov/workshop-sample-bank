<?php

class TokenModel extends CI_Model
{
    public function addClientToken($clientToken, $idUser, $idStore)
    {
        $clientTokenNo = $this->getClientTokensByIdStore($idUser, $idStore);

        if (count($clientTokenNo)) {
            $this->db->insert('client_tokens', $clientToken);
        }

        $this->db->where(['IdUser' => $idUser, 'IdStore' => $idStore])
            ->update('client_tokens', $clientToken);
    }

    /**
     * @param $idUser
     * @return mixed
     */
    public function getTokenData()
    {
        $result = $this->db->select(['client_tokens.IdStore', 'stores.StoreName', 'client_tokens.ClientToken'])
            ->from('client_tokens')
            ->join('stores', 'stores.IdStore = client_tokens.IdStore')
            ->get()
            ->result_array();

        return $result;
    }

    /**
     * @param $idUser
     * @param $idStore
     * @return mixed
     */
    private function getClientTokensByIdStore($idUser, $idStore)
    {
        $result = $this->db->select('*')
            ->from('client_tokens')
            ->where(['IdUser' => $idUser, 'IdStore' => $idStore])
            ->get()
            ->first_row();

        return $result;
    }
}
