<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('404');
		$this->load->view('footer');
	}
}
