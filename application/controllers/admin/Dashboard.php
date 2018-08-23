<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	public function index() {
		if ( !empty( $this->session->userdata['id'] ) && $this->session->userdata['rol'] != 1 ) {
			redirect( base_url());
		}
		$data = array();
		$data['title'] = 'Dashboard';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/footer');
	}
}
