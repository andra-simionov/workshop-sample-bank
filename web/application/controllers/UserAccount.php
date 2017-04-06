<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class UserAccount extends Base_Controller
{
    private $idUser;
    private $userInfo;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->setIdUser($this->session->all_userdata()['IdUser']);
        $this->setUserInfo($this->UserDataModel->getUserInfoByUserId($this->idUser));
    }

    function index()
    {
        $this->load->helper(['form', 'url']);

        $this->load->library('Smartyci');
        $smartyci = new Smartyci();

        $userEmail = $this->userInfo->Email;

        $smartyci->assign('username', $this->userInfo->Username);
        $smartyci->assign('noOfCreditCards', $this->CardDataModel->getUserCardNo($this->idUser));
        $smartyci->assign('balanceCurrency', $this->CardDataModel->getUserBalanceCurrencyByEmail($userEmail));
        $smartyci->assign('balance', $this->CardDataModel->getUserBalanceByEmail($userEmail));
        $smartyci->assign('tokenData', $this->TokenModel->getTokenData($this->idUser));
//var_dump(($this->idUser));die();
        $cardData = $this->CardDataModel->getUserCards($this->idUser);
        $smartyci->assign('cardData', $cardData);

        $smartyci->display('UserAccountView.tpl');
    }

    public function addCreditCard()
    {
        $this->load->helper(['form', 'url']);

        $cardData = [
            'IdUser' => $this->idUser,
            'CardNumber' => $this->input->post('cardno'),
            'ExpirationMonth' => $this->input->post('expirationMonth'),
            'ExpirationYear' => $this->input->post('expirationYear'),
            'Cvv' => $this->input->post('cvv'),
        ];

        $idCard = $this->CardDataModel->addCardData($cardData, $this->idUser);
        $this->CardDataModel->addSoldForCreditCard($idCard);

        redirect('UserAccount');
    }

    public function generateClientToken()
    {
        if ($this->input->post('action') == 'generateClientToken') {
            $idStore = $this->input->post('idStore');
            $clientToken['ClientToken'] = $this->generateUUID();

            $this->TokenModel->addClientToken($clientToken, $this->idUser, $idStore);
        }
    }

    /**
     * @param $idUser
     */
    private function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @param $userInfo
     */
    private function setUserInfo($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * @return string
     */
    private function generateUUID()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
