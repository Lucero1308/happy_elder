<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubicaciones extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('Ubicaciones_model');
	}
	public function index() {
		$data = array();
		$data['title'] = 'Ubicaciones';
		$data['posts'] = $this->Ubicaciones_model->getRows();
		$this->load->view('header', $data);
		$this->load->view('lists_locations', $data);
		$this->load->view('footer');
	}

	public function ver( $slug ) {
		$data['ubicacion'] = $this->Ubicaciones_model->getRowBySlug($slug);
		$data['title'] = '';
		if ( $data['ubicacion'] ) {
			$data['title'] = $data['ubicacion']['name'];
		}
		$this->load->view('header', $data);
		$this->load->view('ver_ubicacion', $data);
		$this->load->view('footer');
	}
}
