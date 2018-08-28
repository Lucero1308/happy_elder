<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informacion extends CI_Controller {
	public function index() {
		$data['title'] = 'Información';
		$this->load->view('header', $data);
		$this->load->view('informacion', $data);
		$this->load->view('footer');
	}
}
