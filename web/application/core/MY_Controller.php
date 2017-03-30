<?php

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        if (!isset($this->session->all_userdata()['Username']))
        {
            redirect('Login');
        }
    }
}
