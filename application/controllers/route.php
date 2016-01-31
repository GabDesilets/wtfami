<?php

/**
 * Class route
 *
 * @property user_routes_model $user_routes_model
 */
class route extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_routes_model');
    }

    public function index()
    {
        echo 'herro';
    }
}