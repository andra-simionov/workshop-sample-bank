<?php

class RegisterForm extends CI_Controller
{
    function index()
    {
        parent::__construct();

        $this->load->helper(['form', 'url']);
        $this->load->library('Smartyci');
        $this->load->library('form_validation');

        $smartyci = new Smartyci();

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');

        $config =  [
            [
                'field'   => 'username',
                'label'   => 'Username',
                'rules'   => 'trim|required|min_length[5]'
            ],
            [
                'field'   => 'password',
                'label'   => 'Password',
                'rules'   => 'trim|required|min_length[5]'
            ],
            [
                'field'   => 'email',
                'label'   => 'Email',
                'rules'   => 'trim|required|min_length[5]'
            ],


        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            $this->RegisterModel->registerUser($username, $password, $email);
        }

        $smartyci->display('RegisterView.tpl');
    }
}
