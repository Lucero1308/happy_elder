<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Servicios_model');
		$this->load->model('Eventos_model');
		$this->load->model('Usuarios_model');
		$this->load->library('form_validation');
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
					$data_post = $this->security->xss_clean($_POST);
					if ( !$this->Usuarios_model->exist( $data_post['userName'], $usuario_id ) ) {
						unset( $data_post['is_submitted'] );
						if ( isset( $data_post['password'] ) && $data_post['password'] ) {
							$data_post['password'] = sha1(md5($data_post['password']));
						} else {
							unset( $data_post['password'] );
						}
						if( $this->Usuarios_model->update($data_post, $usuario_id) ) {
							$user = $this->Usuarios_model->getRows($usuario_id);
							$this->session->set_userdata($user);
							$this->session->set_flashdata('log_success','Se actualizó la cuenta correctamente.');
						} else {
							$data['errors'] = 'Ocurrió un error al actualizar la cuenta.';
						}
					}  else {
						$data['errors'] = 'Ya existe un cuenta con ese correo.';
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

	private function sendMail( $asunto, $contenido, $para ) {
		$config = Array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'ssl://smtp.googlemail.com',
			'smtp_port' 	=> 465, //465 o 587
			'smtp_user' 	=> 'lolivaresv13@gmail.com', //para que no llega spam
			'smtp_pass' 	=> 'Lucki1012',
			'mailtype' 		=> 'html',
			'charset' 		=> 'UTF-8',
			'wordwrap' 		=> TRUE
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from( 'Happy Elder <lolivaresv13@gmail.com>' );
		$this->email->to( $para );
		$this->email->subject( mb_convert_encoding( $asunto, "UTF-8" ) );
		$this->email->message( mb_convert_encoding( $contenido, "UTF-8" ) );
		return $this->email->send();
	}
	
	public function cambiar_contrasena( $hash ) {
		if( $this->isLoggedin() ) {
			redirect( base_url() );
		}
		$data['title'] = 'Enviar_Correo';
		if ( $usuario = $this->Usuarios_model->existbyHash( $hash ) ) {
			if ( isset( $_POST ) && count( $_POST ) ) {
				$config = array(
					array(
						'field' => 'password',
						'label' => 'Contraeña',
						'rules' => 'trim|required'
					),
					array(
						'field' => 'changepassword',
						'label' => 'Repetir contraseña',
						'rules' => 'trim|required'
					),
				);
				$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == false) {
					$data['errors'] = validation_errors();
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['changepassword'] );
					$data_post['password'] = sha1(md5($data_post['password']));
					$data_post['hash'] = sha1( time() );
					if( $this->Usuarios_model->update($data_post, $usuario['id']) ) {
						$user = $this->Usuarios_model->getRows($usuario['id']);
						$this->session->set_userdata($user);
						$this->session->set_flashdata('log_success','Se actualizó la contraseña correctamente.');
						redirect( base_url() );
					} else {
						$data['errors'] = 'Ocurrió un error al actualizar la contraseña.';
					}
				}
			}
			$this->load->view('admin/login_register/header', $data);
			$this->load->view('admin/cambio_contrasena',$data);
			$this->load->view('admin/login_register/footer');
		}
		else {
			$this->session->set_flashdata('log_error','No existe el usuario al que quiere restablecer la contraseña.');
			redirect( base_url() );
		}
	}
	public function restablecer() {
		if( $this->isLoggedin() ) {
			redirect( base_url() );
		}
		$data['title'] = 'Enviar_Correo';

		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'userName',
					'label' => 'Usuario',
					'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				$data_post = $this->security->xss_clean($_POST);
				if ( $usuario =  $this->Usuarios_model->exist( $data_post['userName'] ) ) {
					if ( $usuario['hash'] ) {
						$contenido = '<p style="color: rgb(61, 133, 198);">Restablecer contraseña de HAPPYELDER!</p>
						<p style="color: rgb(61, 133, 198);">
							Hola '. $usuario['fullName'] .' </br>
							Para restablecer tu contraseña - por favor visita http://happyelder.pe/cuenta/cambiar_contrasena/'. $usuario['hash'] . '
						</p>';
						ob_start();
						$this->load->view('admin/plantilla_correo', array( 'contenido' => $contenido ) );
						$html = ob_get_contents();
						ob_end_clean();
						$this->sendMail( "Restablecer contraseña de HAPPYELDER", $html, $usuario['userName'] );
						$this->session->set_flashdata('log_success','Se le envió un correo con un enlace para restablecer su contraseña.');
						redirect( base_url() );

					} else {
						$data['errors'] = 'No existe la cuenta.';
					}
				} else {
					$data['errors'] = 'No existe la cuenta.';
				}
			}
		}
		$this->load->view('admin/login_register/header', $data);
		$this->load->view('admin/enviar_contrasena',$data);
		$this->load->view('admin/login_register/footer');
	}
	public function register() {
		if( $this->isLoggedin() ) {
			redirect( base_url().'admin');
		}
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
					'rules' => 'trim|required'
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				$data_post = $this->security->xss_clean($_POST);
				if ( !$this->Usuarios_model->exist( $data_post['userName'] ) ) {
					$data_post['status'] = 'approved';
					$data_post['fullName'] = $data_post['firstName']. ' ' .$data_post['lastName'];
					$data_post['password'] = sha1(md5($data_post['password']));
					$data_post['hash'] = sha1( time() );
					$user_id = $this->Usuarios_model->insert($data_post);
					if( $user_id ) {
						$user = $this->Usuarios_model->getRows($user_id);
						$this->session->set_userdata($user);
						$this->session->set_flashdata('log_success','Se creó la cuenta correctamente.');
						redirect( base_url().'admin/dashboard');
					}
					$data['errors'] = 'Ocurrió un error al registrar la cuenta.';
				} else {
					$data['errors'] = 'Ya existe un cuenta con ese correo.';
				}
			}
		}
		$data['roles'] = $this->Usuarios_model->getRoles();
		$this->load->view('admin/login_register/header', $data);
		$this->load->view('admin/register');
		$this->load->view('admin/login_register/footer');
	}
	public function login() {
		if( $this->isLoggedin() ) {
			redirect( base_url().'admin');
		}
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
				$data_post = $this->security->xss_clean($_POST);
				$user = $this->Usuarios_model->checkUser($data_post);
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
		$data['evento'] = $this->Eventos_model->getRows( $idevento );
		$data['title'] = 'Editar evento';

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
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);
						if( !$this->Eventos_model->exist( $data_post['slug'], $data['evento']['id'] ) ) {
							$services_id = $this->Eventos_model->update($data_post,  $idevento);
							if( $services_id ) {
								$this->session->set_flashdata('log_success','Se actualizó el evento correctamente.');
								redirect( base_url().'cuenta/eventos');
							}
							$data['errors'] = 'Ocurrió un error al actualizar el evento.';
						} else {
							$data['errors'] = 'Ya existe un evento con ese nombre.';
						}
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);
					if( !$this->Eventos_model->exist( $data_post['slug'], $data['evento']['id'] ) ) {
						$services_id = $this->Eventos_model->update($data_post,  $idevento);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se actualizó el evento correctamente.');
							redirect( base_url().'cuenta/eventos');
						}
						$data['errors'] = 'Ocurrió un error al actualizar el evento.';
					} else {
						$data['errors'] = 'Ya existe un evento con ese nombre.';
					}
				}
			}
		}

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
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);
						if( !$this->Eventos_model->exist( $data_post['slug'] ) ) {
							$services_id = $this->Eventos_model->insert($data_post);
							if( $services_id ) {
								$this->session->set_flashdata('log_success','Se creó el evento correctamente.');
								redirect( base_url().'cuenta/eventos');
							}
							$data['errors'] = 'Ocurrió un error al registrar el evento.';
						} else {
							$data['errors'] = 'Ya existe un evento con ese nombre.';
						}
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);
					if( !$this->Eventos_model->exist( $data_post['slug'] ) ) {
						$services_id = $this->Eventos_model->insert($data_post);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se creó el evento correctamente.');
							redirect( base_url().'cuenta/eventos');
						}
						$data['errors'] = 'Ocurrió un error al registrar el evento.';
					} else {
						$data['errors'] = 'Ya existe un evento con ese nombre.';
					}
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
		$data['servicio'] = $this->Servicios_model->getRows( $idservicio );
		$data['title'] = 'Editar servicio';

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
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);

						if( !$this->Servicios_model->exist( $data_post['slug'], $data['servicio']['id'] ) ) {
							$services_id = $this->Servicios_model->update($data_post,  $idservicio);
							if( $services_id ) {
								$this->session->set_flashdata('log_success','Se actualizó el servicio correctamente.');
								redirect( base_url().'cuenta/servicios');
							}
							$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
						} else {
							$data['errors'] = 'Ya existe un servicio con el mismo nombre.';
						}
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);

					if( !$this->Servicios_model->exist( $data_post['slug'], $data['servicio']['id'] ) ) {
						$services_id = $this->Servicios_model->update($data_post,  $idservicio);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se actualizó el servicio correctamente.');
							redirect( base_url().'cuenta/servicios');
						}
						$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
					} else {
						$data['errors'] = 'Ya existe un servicio con el mismo nombre.';
					}
				}
			}
		}

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
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);
						if( !$this->Servicios_model->exist( $data_post['slug'] ) ) {
							$services_id = $this->Servicios_model->insert($data_post);
							if( $services_id ) {
								$this->session->set_flashdata('log_success','Se creó el servicio correctamente.');
								redirect( base_url().'cuenta/servicios');
							}
							$data['errors'] = 'Ocurrió un error al registrar el servicio.';
						} else {
							$data['errors'] = 'Ya existe un servicio con el mismo nombre.';
						}

					}
				} else {
					$data_post = $this->security->xss_clean($_POST); //eliminar datos maliciosos enviados - SQL INJECTION
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title( convert_accented_characters($data_post['name'] ), 'dash', true);
					if( !$this->Servicios_model->exist( $data_post['slug'] ) ) {
						$services_id = $this->Servicios_model->insert($data_post);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se creó el servicio correctamente.');
							redirect( base_url().'cuenta/servicios');
						}
						$data['errors'] = 'Ocurrió un error al registrar el servicio.';
					} else {
						$data['errors'] = 'Ya existe un servicio con el mismo nombre.';
					}
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
