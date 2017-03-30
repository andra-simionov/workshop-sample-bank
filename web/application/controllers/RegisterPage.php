<?php

class RegisterPage extends MY_Controller
{
    function index()
    {
        parent::__construct();

        $this->load->helper(['form', 'url']);
        $this->load->library('Smartyci');
        $smartyci = new Smartyci();

        $smartyci->display('RegisterView.tpl');
    }
}

