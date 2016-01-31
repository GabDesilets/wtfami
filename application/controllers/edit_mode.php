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

        $description_markers = $this->user_routes_model->get_routes_markers_description($route_id);
        $route = $this->user_routes_model->where_route($route_id)->get_routes();

        $this->load->myView(
            'edit_mode',
            [
                'usr_route' => $user_route,
                'desc_markers' => $description_markers,
                'route' => $route[0]
            ]
        );
    }

    public function readonly($user_id = null, $route_id = null)
    {
        $route_id = $this->input->post('id') ? $this->input->post('id') : $route_id;
        $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;
        $user_route = $this->user_routes_model
            ->where_user($user_id)
            ->where_route($route_id)
            ->get_one_route();

        $description_markers = $this->user_routes_model->get_routes_markers_description($route_id);
        $route = $this->user_routes_model->where_route($route_id)->get_routes();
        
        $this->load->myView(
            'view_mode',
            [
                'usr_route' => $user_route,
                'desc_markers' => $description_markers,
                'route' => $route[0]
            ]
        );
    }

    public function save()
    {
        $route_id = $this->input->post('route_id');
        if ($route_id) {
            $this->user_routes_model->update_routes($this->input->post(), $route_id);
        } else {
            $this->user_routes_model->save_new_routes($this->input->post(), $this->session->userdata('uid'));
        }
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
