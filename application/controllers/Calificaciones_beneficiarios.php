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
		$data['voluntarios'] = $this->Usuarios_model->get_voluntarios(); // ubicado en el modelo del usuario
		$data['enfermeras'] = $this->Usuarios_model->get_enfermeras(); //lista en la vista
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
	public function eliminar( $hash, $commnet_id ) {
		if( !$this->isLoggedin() ) { 
			redirect( base_url() );
		}
		if ( $usuario = $this->Usuarios_model->existbyHash( $hash ) ) {
			$this->load->model('model_comments');
			$this->model_comments->update_coment( array( 'status' => 'trash' ), $commnet_id);
			$this->session->set_flashdata('log_success','Comentario eliminado correctamente');
		}
		redirect(base_url().'calificaciones_beneficiarios/comentarios/'.$hash);
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
			$photo = '';
			$video = '';
			$upload_exist = true;
			if ( $_FILES['photo']['name'] ) {
				$config['upload_path']          = './uploads/';
				$config['overwrite'] = true; 
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 2000;// = MB
				$config['max_width']            = 2000;
				$config['max_height']           = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('photo')) {
					$this->session->set_flashdata('log_error', $this->upload->display_errors() );
					$upload_exist = false;
				} else {
					$upload_image = $this->upload->data();
					$photo = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
				}
			}
			if ( $_FILES['video']['name'] ) {
				$configVideo['upload_path']          = './uploads/';
				$configVideo['overwrite'] = true; 
				$configVideo['allowed_types']        = 'mp4';
				$configVideo['max_size']             = 8000;// = MB
				$configVideo['max_width']            = 2000;
				$configVideo['max_height']           = 1999;
				$this->load->library('upload', $configVideo);
				$this->upload->initialize($configVideo);
				if ( ! $this->upload->do_upload('video')) {
					$upload_exist = false;
					$this->session->set_flashdata('log_error', $this->upload->display_errors() );
				} else {
					$upload_video = $this->upload->data();
					$video = 'http://happyelder.pe/uploads/'.$upload_video['file_name'];
				}
			}
			if ( $upload_exist ) {
				$data = array(
					'post_id' => $usuario['id'],
					'user_id' => $this->session->userdata('id'),
					'comment' => $this->input->post('comment'),
					'val' => $this->input->post('estrellas') | 0,
				);
				if ( $photo ) {
					$data['photo'] = $photo;
				}
				if ( $video ) {
					$data['video'] = $video;
				}
				$this->model_comments->add_comment($data);
				$this->session->set_flashdata('log_success','Se registró el comentario correctamente');
			}
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
	public function buscar(){
		$texto=$this->input->GET('s');
		$data['title']='Resultados para"'. $texto .'"';
		$data['enfermeras']=$this->Usuarios_model->get_enfermeras_busca($texto);
		$data['voluntarios']=$this->Usuarios_model->get_voluntarios_busca($texto);
		$this->load->view('header', $data);
		$this->load->view('calificaciones_beneficiarios',$data);
		$this->load->view('footer');
	}
}