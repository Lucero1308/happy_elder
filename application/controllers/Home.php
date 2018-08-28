<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->model('Servicios_model');
			$this->load->model('Eventos_model');
	}
	public function index() {
		$data['title'] = 'Inicio';
		$this->load->view('header', $data);
		$data['posts'] = $this->Servicios_model->getRows();
		$this->load->view('lists_services', $data);
		$data['posts'] = $this->Eventos_model->getRows();
		$this->load->view('lists_events', $data);
		$this->load->view('footer');
	}
}
