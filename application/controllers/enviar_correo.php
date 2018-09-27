<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class enviar_correo extends CI_Controller {
	public function index() {
		$data['title'] = 'Enviar_Correo';
		$this->load->view('admin/login_register/header', $data);
		$this->load->view('admin/cambio_contrasena',$data);
		$this->load->view('admin/login_register/footer');
	}
}
