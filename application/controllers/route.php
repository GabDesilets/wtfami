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
        $search_string = $this->input->get('search_string');
        $search_routes = $this->user_routes_model->with_search($search_string)->get_routes();

        $this->load->myView('routes_search', ['routes' => $search_routes, 'search' => $search_string]);
    }
}