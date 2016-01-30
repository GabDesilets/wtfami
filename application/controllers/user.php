<?php

/**
 * Class User
 *
 * @property users_model $users_model
 */
class user extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function add_user()
    {
        $data = array(
            'username' => $this->input->post('user_name'),
            'email' => $this->input->post('email_address'),
            'password' => md5($this->input->post('password')),
            'fname'=> $this->input->post('fname'),
            'lname'=> $this->input->post('lname'),

        );

        $this->users_model->insert($data);
    }

}