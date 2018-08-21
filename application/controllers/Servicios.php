<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('lists_thumbs');
		$this->load->view('footer');
	}
}
