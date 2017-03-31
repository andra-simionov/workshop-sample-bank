<?php

class About extends CI_Controller
{
    function index()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('Smartyci');
        $smartyci = new Smartyci();

        $smartyci->display('AboutView.tpl');
    }
}
