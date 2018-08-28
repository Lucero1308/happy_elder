<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('Servicios_model');
		$this->load->model('Eventos_model');
		$this->load->model('Usuarios_model');
		$this->load->library('form_validation');
		$this->load->library('email');
	}
	public function login() {
		$data = array();
		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'userName',
					'label' => 'Usuario',
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
			} else {
				$data_user = $this->security->xss_clean($_POST);
				$user = $this->Login_model->checkUser($data_user);
				if ($user) {
					$this->session->set_userdata($user);
					$this->session->set_flashdata('log_success','Sesión iniciada correctamente');
					redirect(base_url() . 'admin/dashboard');
				} else {
					$data['errors'] = 'Las credenciales ingresadas no son válidas.';
				}
			}
		}
		$this->load->view('admin/login_register/header', $data);
		$this->load->view('admin/login', $data);
		$this->load->view('admin/login_register/footer');
	}
	public function index() {
		$data = array();
		$data['title'] = 'Perfil';
		if( $this->isLoggedin() ) { 
			$usuario_id = $this->session->userdata['id'];
			if ( isset( $_POST ) && count( $_POST ) ) {
				$config = array(
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
						'field' => 'password',
						'label' => 'Contraseña',
						'rules' => 'trim'
					)
				);
				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == false) {
					$data['errors'] = validation_errors();
				} else {
					$data_user = $this->security->xss_clean($_POST);
					unset( $data_user['submit'] );
					unset( $data_user['is_submitted'] );
					if ( isset( $data_user['password'] ) ) {
						$data_user['password'] = sha1(md5($data_user['password']));
					} else {
						unset( $data_user['password'] );
					}
					$user_id = $this->Usuarios_model->update($data_user, $usuario_id);
					if( $user_id ) {
						$this->session->set_flashdata('log_success','Se actualizó la cuenta correctamente.');
						$data_user['is_submitted'] = 1;
						$data_user['submit'] = 1;
					}
				}
			}

			$data['usuario'] = $this->Usuarios_model->getRows( $usuario_id );
			$this->load->view('header', $data);
			$this->load->view('cuenta', $data);
			$this->load->view('footer');
		} else {
			redirect( base_url().'cuenta/login');
		}
	}
	public function isLoggedin() {
		if(!empty($this->session->userdata['id'])) {
			return true;
		}
		else {
			return false;
		}
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'cuenta/login');
	}
	private function validate_sesion() {
		if( !$this->isLoggedin() ) { 
			redirect( base_url().'cuenta/login');
		}
	}

	public function eventos() {
		$this->validate_sesion();
		$data = array();
		$data['list'] = $this->Eventos_model->getRowsByUser( $this->session->userdata['id'] );
		$data['title'] = 'Eventos';
		$this->load->view('header', $data);
		$this->load->view('cuenta_eventos', $data);
		$this->load->view('footer');
	}
	public function editar_evento( $idevento = '' ) {
		$this->validate_sesion();
		$data = array();

		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'name',
					'label' => 'Título',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'description',
					'label' => 'Descripción',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'organizer',
					'label' => 'Organizaciòn',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'location',
					'label' => 'Ubicación',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'dateEvent',
					'label' => 'Fecha',
					'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				if($_FILES['photo']['name'] != '') {
					$config['upload_path']          = './uploads/';
					$config['overwrite'] = true; 
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 2000;// = MB
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('photo')) {
						$data['errors'] =  $this->upload->display_errors();
					} else {
						$upload_image = $this->upload->data();
						$data_post = $this->security->xss_clean($_POST);
						unset( $data_post['submit'] );
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title($data_post['name'], 'dash', true);
						$services_id = $this->Eventos_model->update($data_post,  $idevento);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se actualizó el evento correctamente.');
							redirect( base_url().'cuenta/eventos');
						}
						$data['errors'] = 'Ocurrió un error al actualizar el evento.';
						$data_post['is_submitted'] = 1;
						$data_post['submit'] = 1;
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['submit'] );
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title($data_post['name'], 'dash', true);
					$services_id = $this->Eventos_model->update($data_post,  $idevento);
					if( $services_id ) {
						$this->session->set_flashdata('log_success','Se actualizó el evento correctamente.');
						redirect( base_url().'cuenta/eventos');
					}
					$data['errors'] = 'Ocurrió un error al actualizar el evento.';
					$data_post['is_submitted'] = 1;
					$data_post['submit'] = 1;
				}
			}
		}

		$data['evento'] = $this->Eventos_model->getRows( $idevento );
		$data['title'] = 'Editar evento';
		$this->load->view('header', $data);
		$this->load->view('editar_evento', $data);
		$this->load->view('footer');
	}
	public function registrar_evento() {
		$this->validate_sesion();
		$data = array();

		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'name',
					'label' => 'Título',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'description',
					'label' => 'Descripción',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'organizer',
					'label' => 'Organizaciòn',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'location',
					'label' => 'Ubicación',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'dateEvent',
					'label' => 'Fecha',
					'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				if($_FILES['photo']['name'] != '') {
					$config['upload_path']          = './uploads/';
					$config['overwrite'] = true; 
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 2000;// = MB
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('photo')) {
						$data['errors'] =  $this->upload->display_errors();
					} else {
						$upload_image = $this->upload->data();
						$data_post = $this->security->xss_clean($_POST);
						unset( $data_post['submit'] );
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title($data_post['name'], 'dash', true);
						$services_id = $this->Eventos_model->insert($data_post);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se creó el evento correctamente.');
							redirect( base_url().'cuenta/eventos');
						}
						$data['errors'] = 'Ocurrió un error al actualizar el evento.';
						$data_post['is_submitted'] = 1;
						$data_post['submit'] = 1;
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['submit'] );
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title($data_post['name'], 'dash', true);
					$services_id = $this->Eventos_model->insert($data_post);
					if( $services_id ) {
						$this->session->set_flashdata('log_success','Se creó el evento correctamente.');
						redirect( base_url().'cuenta/eventos');
					}
					$data['errors'] = 'Ocurrió un error al actualizar el evento.';
					$data_post['is_submitted'] = 1;
					$data_post['submit'] = 1;
				}
			}
		}

		$data['evento'] = array();
		$data['title'] = 'Registrar evento';
		$this->load->view('header', $data);
		$this->load->view('registrar_evento', $data);
		$this->load->view('footer');
	}

	public function servicios() {
		$this->validate_sesion();
		$data = array();
		$data['list'] = $this->Servicios_model->getRowsByUser( $this->session->userdata['id'] );
		$data['title'] = 'Servicios';
		$this->load->view('header', $data);
		$this->load->view('cuenta_servicios', $data);
		$this->load->view('footer');
	}
	public function editar_servicio( $idservicio = '' ) {
		$this->validate_sesion();
		$data = array();

		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'name',
					'label' => 'Título',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'description',
					'label' => 'Descripción',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'schedule',
					'label' => 'Horario',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'price',
					'label' => 'Precio',
					'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				if($_FILES['photo']['name'] != '') {
					$config['upload_path']          = './uploads/';
					$config['overwrite'] = true; 
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 2000;// = MB
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('photo')) {
						$data['errors'] =  $this->upload->display_errors();
					} else {
						$upload_image = $this->upload->data();
						$data_post = $this->security->xss_clean($_POST);
						unset( $data_post['submit'] );
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title($data_post['name'], 'dash', true);
						$services_id = $this->Servicios_model->update($data_post,  $idservicio);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se actualizó el servicio correctamente.');
							redirect( base_url().'cuenta/servicios');
						}
						$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
						$data_post['is_submitted'] = 1;
						$data_post['submit'] = 1;
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['submit'] );
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title($data_post['name'], 'dash', true);
					$services_id = $this->Servicios_model->update($data_post,  $idservicio);
					if( $services_id ) {
						$this->session->set_flashdata('log_success','Se actualizó el servicio correctamente.');
						redirect( base_url().'cuenta/servicios');
					}
					$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
					$data_post['is_submitted'] = 1;
					$data_post['submit'] = 1;
				}
			}
		}

		$data['servicio'] = $this->Servicios_model->getRows( $idservicio );
		$data['title'] = 'Editar servicio';
		$this->load->view('header', $data);
		$this->load->view('editar_servicio', $data);
		$this->load->view('footer');
	}
	public function registrar_servicio() {
		$this->validate_sesion();
		$data = array();

		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'name',
					'label' => 'Título',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'description',
					'label' => 'Descripción',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'schedule',
					'label' => 'Horario',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'price',
					'label' => 'Precio',
					'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				if($_FILES['photo']['name'] != '') {
					$config['upload_path']          = './uploads/';
					$config['overwrite'] = true; 
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 2000;// = MB
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('photo')) {
						$data['errors'] =  $this->upload->display_errors();
					} else {
						$upload_image = $this->upload->data();
						$data_post = $this->security->xss_clean($_POST);
						unset( $data_post['submit'] );
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title($data_post['name'], 'dash', true);
						$services_id = $this->Servicios_model->insert($data_post);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se creó el servicio correctamente.');
							redirect( base_url().'cuenta/servicios');
						}
						$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
						$data_post['is_submitted'] = 1;
						$data_post['submit'] = 1;
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['submit'] );
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title($data_post['name'], 'dash', true);
					$services_id = $this->Servicios_model->insert($data_post);
					if( $services_id ) {
						$this->session->set_flashdata('log_success','Se creó el servicio correctamente.');
						redirect( base_url().'cuenta/servicios');
					}
					$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
					$data_post['is_submitted'] = 1;
					$data_post['submit'] = 1;
				}
			}
		}

		$data['servicio'] = array();
		$data['title'] = 'Registrar servicio';
		$this->load->view('header', $data);
		$this->load->view('registrar_servicio', $data);
		$this->load->view('footer');
	}
}
