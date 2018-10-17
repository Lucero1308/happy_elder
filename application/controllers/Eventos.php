<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('Eventos_model');
	}
	public function index() {
		$data = array();
		$data['title'] = 'Eventos';
		$data['posts'] = $this->Eventos_model->getRows();
		$this->load->view('header', $data);
		$this->load->view('lists_events', $data);
		$this->load->view('footer');
	}
	
	public function ver( $slug ) {
		$data['evento'] = $this->Eventos_model->getRowBySlug($slug);
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'complete' ) {
			if( $data['evento'] ) {
				$this->session->set_flashdata('log_success','Gracias por hacer una donación.');
				$services_id = $this->Eventos_model->update( array( 'donaciones' => ++$data['evento']['donaciones'] ),  $data['evento']['id'] );
			}
		}
		$data['title'] = '';
		if ( $data['evento'] ) {
			$data['title'] = $data['evento']['name'];
		}
		$this->load->view('header', $data);
		$this->load->view('ver_evento', $data);
		$this->load->view('footer');
	}
}
