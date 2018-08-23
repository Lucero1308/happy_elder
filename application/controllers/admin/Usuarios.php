<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Usuarios_model');
	}
	public function index() {
		if ( !empty( $this->session->userdata['id'] ) && $this->session->userdata['rol'] != 1 ) {
			redirect( base_url());
		}
		$data = array();
		$data['list'] = $this->Usuarios_model->getRows();
		$data['title'] = 'Usuarios';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/usuarios', $data);
		$this->load->view('admin/footer');
	}
	public function eliminar() {
		$id=$this->uri->segment(4);
		$check=$this->Usuarios_model->update( array( 'status' => 'trash' ), $id);
		if($check) {
			$this->session->set_flashdata('log_success','Usuario eliminado correctamente');
		}
		else {
			$this->session->set_flashdata('log_error','Ocurruó un error al eliminar el usuario');
		}
		redirect(base_url().'admin/usuarios');
	}
}
