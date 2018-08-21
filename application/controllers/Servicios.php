<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('services');
	}
	public function index() {
		$data = array();
		$data['posts'] = $this->services->getRows();
		$this->load->view('header');
		$this->load->view('lists_services', $data);
		$this->load->view('footer');
	}
}
