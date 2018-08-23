<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Servicios_model');
	}
	public function index() {
		if ( !empty( $this->session->userdata['id'] ) && $this->session->userdata['rol'] != 1 ) {
			redirect( base_url());
		}
		$data = array();
		$data['list'] = $this->Servicios_model->getRows();
		$data['title'] = 'Servicios';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/servicios', $data);
		$this->load->view('admin/footer');
	}
	public function eliminar() {
		$id=$this->uri->segment(4);
		$check=$this->Servicios_model->update( array( 'status' => 'trash' ), $id);
		if($check) {
			$this->session->set_flashdata('log_success','Servicio eliminado correctamente');
		}
		else {
			$this->session->set_flashdata('log_error','Ocurruó un error al eliminar el servicio');
		}
		redirect(base_url().'admin/servicios');
	}
}
