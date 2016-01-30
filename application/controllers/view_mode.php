<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_Mode extends CI_Controller {

	public function index()
	{
		$this->load->myView('view_mode');
	}
}
