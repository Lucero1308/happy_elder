<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {
		$data = array();
		$data['bodyClass'] = 'register';
		$this->load->view('admin/login_register/header', $data);
		$this->load->view('admin/register');
		$this->load->view('admin/login_register/footer');
	}
}
