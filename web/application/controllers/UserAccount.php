<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class UserAccount extends CI_Controller
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

        $smartyci->assign('username', $this->userInfo->Username);
        $smartyci->assign('noOfCreditCards', $this->CardDataModel->getUserCardNo($this->idUser));
        $smartyci->assign('soldCurrency', $this->CardDataModel->getUserSoldCurrencyByEmail($this->userInfo->Email));
        $smartyci->assign('totalSold', $this->CardDataModel->getUserSold($this->idUser));

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

        $this->CardDataModel->addCardData($cardData, $this->idUser);

        redirect('UserAccount');
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
}
