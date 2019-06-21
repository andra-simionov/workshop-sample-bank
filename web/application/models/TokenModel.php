<?php

class TokenModel extends CI_Model
{
    public function addClientToken($clientToken, $idUser, $storeName)
    {
        $idStore = $this->getStoreIdByStoreName($storeName);

        if (is_null($this->getClientTokenByIdStore($idUser, $idStore))){
            $dataToBeInserted = [
                'IdUser' => $idUser,
                'IdStore' => $idStore,
                'ClientToken' => $clientToken,
                'AddDate' => date('Y-m-d H:i:s'),
                ];

            $this->db->insert('client_tokens', $dataToBeInserted);
        } else {

            $this->db->where(['IdUser' => $idUser, 'IdStore' => $idStore])
                ->update('client_tokens', ['ClientToken' => $clientToken]);
        }

    }

    /**
     * @param $idUser
     * @return mixed
     */
    public function getTokenData($idUser)
    {
        $result = $this->db->select(['client_tokens.IdStore', 'stores.StoreName', 'client_tokens.ClientToken'])
            ->from('client_tokens')
            ->join('stores', 'stores.IdStore = client_tokens.IdStore')
            ->where('client_tokens.IdUser', $idUser)
            ->get()
            ->result_array();
        $tokenByStore = [];

        foreach ($result as $input) {
            $tokenByStore[$input['StoreName']] = $input['ClientToken'];
        }

        return $tokenByStore;
    }

    /**
     * @param $idUser
     * @param $idStore
     * @return mixed
     */
    private function getClientTokenByIdStore($idUser, $idStore)
    {
        $result = $this->db->select('*')
            ->from('client_tokens')
            ->where(['client_tokens.IdUser' => $idUser, 'client_tokens.IdStore' => $idStore])
            ->get()
            ->first_row();

        return $result;
    }

    public function getAllStores()
    {
        $result = $this->db->select('*')
            ->from('stores')
            ->get()
            ->result_array();

        return $result;
    }

    /**
     * @param $storeName
     * @return mixed
     */
    private function getStoreIdByStoreName($storeName)
    {
        $result = $this->db->select('IdStore')
            ->from('stores')
            ->where('stores.StoreName', $storeName)
            ->get()
            ->row_array();

        return $result['IdStore'];
    }
}
