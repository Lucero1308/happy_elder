<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('Eventos_model');
	}
	public function index() {
		$data = array();
		$data['title'] = 'Eventos';
		$data['posts'] = $this->Eventos_model->getRows();
		$this->load->view('header', $data);
		$this->load->view('lists_events', $data);
		$this->load->view('footer');
	}
	
	public function ver( $slug ) {
		$data['servicio'] = $this->Eventos_model->getRowBySlug($slug);
		$data['title'] = '';
		if ( $data['servicio'] ) {
			$data['title'] = $data['servicio']['name'];
		}
		$this->load->view('header', $data);
		$this->load->view('ver_servicio', $data);
		$this->load->view('footer');
	}
}
