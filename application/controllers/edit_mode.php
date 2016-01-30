<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_Mode extends CI_Controller {

	public function index()
	{
		$this->load->view('edit_mode');
	}
}
