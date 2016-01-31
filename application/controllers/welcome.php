<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Welcome
 *
 * @property user_routes_model $user_routes_model
 */
class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_routes_model');
    }

    public function index()
    {
        $is_log = $this->session->userdata('is_logged_in');
        if ($is_log) {
            $user_routes = $this->user_routes_model
                ->where_user($this->session->userdata('uid'))
                ->get_routes();
            $this->load->myView('routes_index', ['routes' => $user_routes]);
        } else {
            $this->load->view('welcome_message');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */