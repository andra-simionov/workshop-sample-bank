<?php

class UserProfile extends CI_Controller
{
    function index()
    {
        parent::__construct();

        $this->load->library('Smartyci');
        $smartyci = new Smartyci();

        $smartyci->display('UserProfileView.tpl');
    }
}
