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
		$data['list'] = $this->Usuarios_model->getRowsAdmin();
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
			if ($this->form_validation->run() == false) { //validacion del servidor
				$data['errors'] = validation_errors();
			} else {
				$data_post = $this->security->xss_clean($_POST); //limpiar codigos maliciosos antes de guardar en la bd
				if ( !$this->Usuarios_model->exist( $data_post['userName'], $usuario_id ) ) {
					unset( $data_post['is_submitted'] );
					if ( isset( $data_post['password'] ) && $data_post['password'] ) {
						$data_post['password'] = sha1(md5($data_post['password'])); //doble encriptacion
					} else {
						unset( $data_post['password'] );
					}
					$data_post['fullName'] = $data_post['firstName']. ' ' .$data_post['lastName'];
					if( $this->Usuarios_model->update($data_post, $usuario_id) ) {
						$this->session->set_flashdata('log_success','Se actualizó la cuenta correctamente.');
						redirect( base_url().'admin/usuarios');
					}
					$data['errors'] = 'Ocurrió un error al actualizar la cuenta.';
				}  else {
					$data['errors'] = 'Ya existe un cuenta con ese correo.';
				}
			}
		}
		$data['usuario'] = $this->Usuarios_model->getRows( $usuario_id );
		$data['roles'] = $this->Usuarios_model->getRoles();
		$data['title'] = 'Editar usuario';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/editar_usuario', $data);
		$this->load->view('admin/footer');
	}
	public function aprobar( $usuario_id ) {
		$data = array();
		$data['usuario'] = $this->Usuarios_model->getRowsAdmin( $usuario_id );
		if ( $data['usuario'] ) {
			$data_post = array();
			$data_post['status'] = 'approved';
			if( $this->Usuarios_model->update($data_post, $usuario_id) ) {
				$contenido = '<p style="color: rgb(61, 133, 198);">Cuenta aprobada en HAPPYELDER!</p>
				<p style="color: rgb(61, 133, 198);">
					Hola '. $data['usuario']['fullName'] .' </br>
					Ya puedes iniciar sesión en http://happyelder.pe/
				</p>';
				ob_start();// activa una opcion para cargar la vista pero almacena en algún lugar de la memoria
				$this->load->view('admin/plantilla_correo', array( 'contenido' => $contenido ) );
				$html = ob_get_contents(); //ALMACENAR - contenido
				ob_end_clean();
				$this->sendMail( "Cuenta aprobada en HAPPYELDER", $html, $data['usuario']['userName'] );
				$this->session->set_flashdata('log_success','Se aprobó correctamente la cuenta correctamente.');
			} else {
				$this->session->set_flashdata('log_error','Ocurrió un error al aprobar la cuenta.');
			}
		} else {
			$this->session->set_flashdata('log_error','No existe el cliente.');
		}
		//redirect( base_url() .'admin/usuarios' );
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
			} else {
				$data_post = $this->security->xss_clean($_POST);
				unset( $data_post['is_submitted'] );
				if ( !$this->Usuarios_model->exist( $data_post['userName'] ) ) {
					$data_post['status'] = 'pending';
					$data_post['fullName'] = $data_post['firstName']. ' ' .$data_post['lastName'];
					$data_post['password'] = sha1(md5($data_post['password']));
					$data_post['hash'] = sha1( time() );
					$user_id = $this->Usuarios_model->insert($data_post);
					if( $user_id ) {
						$this->session->set_flashdata('log_success','Se creó la cuenta correctamente.');
						redirect( base_url().'admin/usuarios');
					}
					$data['errors'] = 'Ocurrió un error al registrar la cuenta.';
				} else {
					$data['errors'] = 'Ya existe un cuenta con ese correo.';
				}
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
