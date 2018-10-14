<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentar extends CI_Controller {
	public function index() {
		$data['title'] = 'Publicar comentario';

		$this->load->view('header', $data);
		$this->load->view('comentar', $data);
		$this->load->view('footer');
	}
}
