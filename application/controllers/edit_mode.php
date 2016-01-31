<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Edit_Mode
 *
 * @property user_routes_model $user_routes_model
 */
class Edit_Mode extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_routes_model');
    }

    public function index()
    {
        $this->load->myView('edit_mode');
    }

    public function edit()
    {
        $route_id = $this->input->post('id');
        $user_route = $this->user_routes_model
            ->where_user($this->session->userdata('uid'))
            ->where_route($route_id)
            ->get_one_route();

        $this->load->myView('edit_mode', ['route' => $user_route]);
    }

    public function save()
    {
        die(var_dump($_POST));
    }

    public function add()
    {
        $this->load->myView('edit_mode');
    }

    public function delete()
    {
        $route_id = $this->input->post('id');
        $this->user_routes_model->delete($route_id, $this->session->userdata('uid'));
        redirect('welcome/index');
    }
}
