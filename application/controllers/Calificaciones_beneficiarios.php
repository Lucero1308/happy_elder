<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificaciones_beneficiarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Usuarios_model');
	}
	public function index() {
		$data['title'] = 'Beneficioso';
		$data['voluntarios'] = $this->Usuarios_model->get_voluntarios();
		$data['enfermeras'] = $this->Usuarios_model->get_enfermeras();
		$this->load->view('header', $data);
		$this->load->view('calificaciones_beneficiarios', $data);
		$this->load->view('footer');
	}
	public function comentarios( $hash ) {
		$data['title'] = 'Comentarios';
		$this->load->model('model_comments');
		if ( $usuario = $this->Usuarios_model->existbyHash( $hash ) ) {
			$data['comments'] = $this->model_comments->get_comments( $usuario['id'] );
			$data['usuario'] = $usuario;
		} else {
			redirect( base_url() );
		}

		$this->load->view('header', $data);
		$this->load->view('comentar', $data);
		$this->load->view('footer');
	}
	public function comentar( $hash ) {
		if( !$this->isLoggedin() ) { 
			redirect( base_url() );
		}
		if(!$this->input->post()) {
			redirect( base_url() );
		}
		if ( $usuario = $this->Usuarios_model->existbyHash( $hash ) ) {
			$usr_id = $this->session->userdata('id');
			$this->load->model('model_comments');
			$data = array(
				'post_id' => $usuario['id'],
				'user_id' => $this->session->userdata('id'),
				'comment' => $this->input->post('comment'),
			);
			$this->model_comments->add_comment($data);
			$this->session->set_flashdata('log_success','Se registró el comentario correctamente');
		} else {
			redirect( base_url() );
		}
		redirect(base_url().'calificaciones_beneficiarios/comentarios/'.$hash);
	}
	public function isLoggedin() {
		if(!empty($this->session->userdata['id'])) {
			return true;
		}
		else {
			return false;
		}
	}
}
