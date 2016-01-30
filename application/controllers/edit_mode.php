<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_Mode extends CI_Controller {

	public function index()
	{
		$this->load->myView('edit_mode');
	}
}
