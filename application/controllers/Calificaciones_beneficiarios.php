<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificaciones_beneficiarios extends CI_Controller {
	public function index() {
		$data['title'] = 'Beneficioso';
		$this->load->view('header', $data);
		$this->load->view('calificaciones_beneficiarios', $data);
		$this->load->view('footer');
	}a
}
