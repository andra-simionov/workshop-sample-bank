<?php

class UserProfile extends CI_Controller
{
    private $username;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->setUsername($this->session->all_userdata()['Username']);
    }

    function index()
    {
        $this->load->helper(['form', 'url']);

        $this->load->library('Smartyci');
        $smartyci = new Smartyci();

        $smartyci->assign('username', $this->username);
        $smartyci->assign('noOfCreditCards', $this->UserProfileModel->getUserCardNo($this->username));

        $smartyci->display('UserProfileView.tpl');
    }

    public function addCreditCard()
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('Smartyci');

        $smartyci = new Smartyci();

        $cardData = [
            'IdUser' => $this->LoginModel->getUserIdByUserName($this->username),
            'CardNumber' => $this->input->post('cardno'),
            'ExpirationDate' => $this->input->post('expirationDate'),
            'Cvv' => $this->input->post('cvv'),
            'Sold' => $this->input->post('sold'),
        ];
        $this->UserProfileModel->addCardData($cardData, $this->username);
        $smartyci->display('UserProfileView.tpl');
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
}
