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
		if ( !empty( $this->session->userdata['id'] ) && $this->session->userdata['rol'] != 1 ) {
			redirect( base_url());
		}
		$data = array();
		$data['list'] = $this->Eventos_model->getRows();
		$data['title'] = 'Eventos';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/eventos', $data);
		$this->load->view('admin/footer');
	}
	public function eliminar() {
		$id=$this->uri->segment(4);
		$check=$this->Eventos_model->update( array( 'status' => 'trash' ), $id);
		if($check) {
			$this->session->set_flashdata('log_success','Evento eliminado correctamente');
		}
		else {
			$this->session->set_flashdata('log_error','Ocurruó un error al eliminar el eventos');
		}
		redirect(base_url().'admin/eventos');
	}
}
