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

        $config =  [
            [
                'field'   => 'firstname',
                'label'   => 'Firstname',
                'rules'   => 'trim|required'
            ],
            [
                'field'   => 'lastname',
                'label'   => 'Lastname',
                'rules'   => 'trim|required'
            ],
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

            $userData = [
                'FirstName' => $this->input->post('firstname'),
                'LastName' => $this->input->post('lastname'),
                'Username' => $this->input->post('username'),
                'Email' => $this->input->post('email'),
                'Password' => $this->input->post('password'),
            ];

            $this->RegisterModel->registerUser($userData);
        }

        $smartyci->display('RegisterView.tpl');
    }
}
