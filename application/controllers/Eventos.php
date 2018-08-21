<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('events');
	}
	public function index() {

		$data = array();
		$data['posts'] = $this->events->getRows();
		$this->load->view('header');
		$this->load->view('lists_events', $data);
		$this->load->view('footer');
	}
}
