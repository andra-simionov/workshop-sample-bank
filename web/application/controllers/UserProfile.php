<?php

class UserProfile extends MY_Controller
{
    private $username;
    private $idUser;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->setUsername($this->session->all_userdata()['Username']);
        $this->setIdUser($this->LoginModel->getUserIdByUserName($this->username));
    }

    function index()
    {
        $this->load->helper(['form', 'url']);

        $this->load->library('Smartyci');
        $smartyci = new Smartyci();

        $smartyci->assign('username', $this->username);
        $smartyci->assign('noOfCreditCards', $this->UserProfileModel->getUserCardNo($this->idUser));
        $smartyci->assign('totalSold', $this->UserProfileModel->getUserSold($this->idUser));

        $cardData = $this->UserProfileModel->getUserCards($this->idUser);
        $smartyci->assign('cardData', $cardData);

        $smartyci->display('UserProfileView.tpl');
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

        $this->UserProfileModel->addCardData($cardData, $this->idUser);

        redirect('UserProfile');
    }

    /**
     * @param mixed $username
     */
    private function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param $idUser
     */
    private function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
}
