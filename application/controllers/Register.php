<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('Usuarios_model');
		$this->load->library('form_validation');
	}
	public function index() {
		$data = array();
		$data['bodyClass'] = 'register';
		if( $this->isLoggedin() ) { 
			redirect( base_url().'admin/dashboard');
		}
		$data['roles'] = $this->Usuarios_model->getRoles();
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
					'rules' => 'trim|required'
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

				if ( !$this->Login_model->checkUserName( $data_user['userName'] ) ) {
					$user_id = $this->Login_model->register($data_user);
					if( $user_id ) {
						$user = $this->Login_model->getById($user_id);
						if( $user ) {
							$this->session->set_userdata($user);
							$this->session->set_flashdata('log_success','Se creó la cuenta correctamente.');
							redirect( base_url().'admin/dashboard');
						}
					}
				}
				$data['errors'] = 'Ya existe un cuenta con ese mismo correo.';
			}
		}
		$this->load->view('admin/login_register/header', $data);
		$this->load->view('admin/register');
		$this->load->view('admin/login_register/footer');
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
