<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificaciones_beneficiarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Usuarios_model');
	}
	public function index() {
		$data['title'] = 'Beneficioso';
		$data['voluntarios'] = $this->Usuarios_model->get_voluntarios();
		$data['enfermeras'] = $this->Usuarios_model->get_enfermeras();
		$this->load->view('header', $data);
		$this->load->view('calificaciones_beneficiarios', $data);
		$this->load->view('footer');
	}
}
