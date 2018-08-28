<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('Servicios_model');
	}
	public function index() {
		$data = array();
		$data['title'] = 'Servicios';
		$data['posts'] = $this->Servicios_model->getRows();
		$this->load->view('header', $data);
		$this->load->view('lists_services', $data);
		$this->load->view('footer');
	}

	public function ver( $slug ) {
		$data['servicio'] = $this->Servicios_model->getRowBySlug($slug);
		$data['title'] = '';
		if ( $data['servicio'] ) {
			$data['title'] = $data['servicio']['name'];
		}
		$this->load->view('header', $data);
		$this->load->view('ver_servicio', $data);
		$this->load->view('footer');
	}
}
