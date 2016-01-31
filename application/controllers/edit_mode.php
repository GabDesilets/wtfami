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
        // TODO HAVE JS STUFF FOR EDIT
    }

    public function delete()
    {
        $route_id = $this->input->post('id');
        $this->user_routes_model->delete($route_id, $this->session->userdata('uid'));
        redirect('welcome/index');
    }
}
