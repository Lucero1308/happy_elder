<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Usuarios_model');
		$this->validate_sesion();
	}
	private function validate_sesion() {
		if( !$this->isLoggedin() ) { 
			redirect( base_url() );
		}
	}
	public function isLoggedin() {
		if(! empty($this->session->userdata['id']) && $this->session->userdata['rol'] == 1 ) {
			return true;
		}
		else {
			return false;
		}
	}
	public function index() {
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
	public function editar( $usuario_id ) {
		$data = array();
		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'firstName',
					'label' => 'Nombres',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'lastName',
					'label' => 'Apellidos',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'userName',
					'label' => 'Usuario',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'telephone',
					'label' => 'Teléfono',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'rol',
					'label' => 'Rol',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'password',
					'label' => 'Contraseña',
					'rules' => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
			} else {
				$data_user = $this->security->xss_clean($_POST);
				$inputUseId = $data_user['inputUseId'];
				unset( $data_user['submit'] );
				unset( $data_user['is_submitted'] );
				unset( $data_user['inputUseId'] );
				if ( isset( $data_user['password'] ) ) {
					$data_user['password'] = sha1(md5($data_user['password']));
				} else {
					unset( $data_user['password'] );
				}
				$user_id = $this->Usuarios_model->update($data_user, $inputUseId);
				if( $user_id ) {
					$this->session->set_flashdata('log_success','Se actualizó la cuenta correctamente.');
					redirect( base_url().'admin/usuarios');
				}
				$data_user['is_submitted'] = 1;
				$data_user['submit'] = 1;
			}
		}
		$data['usuario'] = $this->Usuarios_model->getRows( $usuario_id );
		$data['roles'] = $this->Usuarios_model->getRoles();
		$data['title'] = 'Editar usuario';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/editar_usuario', $data);
		$this->load->view('admin/footer');
	}
	public function registrar( ) {
		$data = array();
		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'firstName',
					'label' => 'Nombres',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'lastName',
					'label' => 'Apellidos',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'userName',
					'label' => 'Usuario',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'telephone',
					'label' => 'Teléfono',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'rol',
					'label' => 'Rol',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'password',
					'label' => 'Contraseña',
					'rules' => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
			} else {
				$data_user = $this->security->xss_clean($_POST);
				unset( $data_user['submit'] );
				unset( $data_user['is_submitted'] );

				$data_user['status'] = 'approved';
				$data_user['password'] = sha1(md5($data_user['password']));
				$data_user['hash'] = sha1(md5($this->session->userdata['session_id']));
				$user_id = $this->Usuarios_model->insert($data_user);
				if( $user_id ) {
					$this->session->set_flashdata('log_success','Se creó la cuenta correctamente.');
					redirect( base_url().'admin/usuarios');
				}
				$data_user['is_submitted'] = 1;
				$data_user['submit'] = 1;
			}
		}

		$data['usuario'] = [];
		$data['roles'] = $this->Usuarios_model->getRoles();
		$data['title'] = 'Registrar usuario';


		$this->load->view('admin/header', $data);
		$this->load->view('admin/registrar_usuario', $data);
		$this->load->view('admin/footer');
	}
}
