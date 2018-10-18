<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Servicios_model');
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
		$data['list'] = $this->Servicios_model->getRowsAdmin();
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

	public function editar( $idservicio = '' ) {
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
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('photo')) {
						$data['errors'] =  $this->upload->display_errors();
					} else {
						$upload_image = $this->upload->data();
						$data_post = $this->security->xss_clean($_POST);
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						//$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title ( convert_accented_characters($data_post['name'] ), 'dash', true);
						if( !$this->Servicios_model->exist( $data_post['slug'], $data['servicio']['id'] ) ) {
							$services_id = $this->Servicios_model->update($data_post,  $idservicio);
							if( $services_id ) {
								$this->session->set_flashdata('log_success','Se actualizó el servicio correctamente.');
								redirect( base_url().'admin/servicios');
							}
							$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
						} else {
							$data['errors'] = 'Ya existe un servicio con el mismo nombre.';
						}
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['is_submitted'] );

					//$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title ( convert_accented_characters($data_post['name'] ), 'dash', true);
					if( !$this->Servicios_model->exist( $data_post['slug'], $data['servicio']['id'] ) ) {
						$services_id = $this->Servicios_model->update($data_post,  $idservicio);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se actualizó el servicio correctamente.');
							redirect( base_url().'admin/servicios');
						}
						$data['errors'] = 'Ocurrió un error al actualizar el servicio.';
					} else {
						$data['errors'] = 'Ya existe un servicio con el mismo nombre.';
					}
				}
			}
		}

		$this->load->view('admin/header', $data);
		$this->load->view('admin/editar_servicio', $data);
		$this->load->view('admin/footer');
	}
	public function registrar() {
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
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('photo')) {
						$data['errors'] =  $this->upload->display_errors();
					} else {
						$upload_image = $this->upload->data();
						$data_post = $this->security->xss_clean($_POST);
						unset( $data_post['is_submitted'] );
						$data_post['photo'] = 'http://happyelder.pe/uploads/'.$upload_image['file_name'];
						$data_post['user_id'] = $this->session->userdata['id'];
						$data_post['slug'] = url_title ( convert_accented_characters($data_post['name'] ), 'dash', true);
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
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['is_submitted'] );

					$data_post['user_id'] = $this->session->userdata['id'];
					$data_post['slug'] = url_title ( convert_accented_characters($data_post['name'] ), 'dash', true);
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/registrar_servicio', $data);
		$this->load->view('admin/footer');
	}
}
