<?php

class Logout extends MY_Controller
{
    function index()
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
        $this->load->library('Smartyci');
        $smartyci = new Smartyci();

        $this->session->sess_destroy();
        $smartyci->display('LoginView.tpl');
    }
}




