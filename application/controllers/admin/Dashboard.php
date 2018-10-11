<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->validate_sesion();
	}
	public function index() {
		$this->load->model('Eventos_model');
		$this->load->model('Usuarios_model');
		$this->load->model('Servicios_model');
		$this->load->model('Ubicaciones_model');
		

		$data = array();
		$data['usuarios'] = $this->Usuarios_model->getCountTypes();
		$data['servicios'] = $this->Servicios_model->getCountTypes();
		$data['eventos'] = $this->Eventos_model->getCountTypes();
		$data['ubicaciones'] = $this->Ubicaciones_model->getCountTypes();
		$data['title'] = 'Dashboard';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer');
		
	}
	private function validate_sesion() {
		if( !$this->isLoggedin() ) { 
			redirect( base_url() );
		}
	}
	public function isLoggedin() {
		if(! empty($this->session->userdata['id']) && $this->session->userdata['rol'] == 1 ) {
			return true;
		}
		else {
			return false;
		}
	}
}
