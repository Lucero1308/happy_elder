<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubicaciones extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Ubicaciones_model');
		$this->validate_sesion();
	}
	private function validate_sesion() {
		if( !$this->isLoggedin() ) { 
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
	public function index() {
		if ( !empty( $this->session->userdata['id'] ) && $this->session->userdata['rol'] != 1 ) {
			redirect( base_url());
		}
		$data = array();
		$data['list'] = $this->Ubicaciones_model->getRows();
		$data['title'] = 'Ubicaciones';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/ubicaciones', $data);
		$this->load->view('admin/footer');
	}
	public function eliminar() {
		$id=$this->uri->segment(4);
		$check=$this->Ubicaciones_model->update( array( 'status' => 'trash' ), $id);
		if($check) {
			$this->session->set_flashdata('log_success','Ubicación eliminado correctamente');
		}
		else {
			$this->session->set_flashdata('log_error','Ocurruó un error al eliminar la ubicación');
		}
		redirect(base_url().'admin/ubicaciones');
	}
	public function editar( $idubicacion = '' ) {
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
					'field' => 'address',
					'label' => 'Dirección',
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
						$data_post['slug'] = url_title($data_post['name'], 'dash', true);
						$services_id = $this->Ubicaciones_model->update($data_post,  $idubicacion);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se actualizó la ubicación correctamente.');
							redirect( base_url().'admin/ubicaciones');
						}
						$data['errors'] = 'Ocurrió un error al actualizar la ubicación.';
						$data_post['is_submitted'] = 1;
						$data_post['submit'] = 1;
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['submit'] );
					unset( $data_post['is_submitted'] );

					$data_post['slug'] = url_title($data_post['name'], 'dash', true);
					$services_id = $this->Ubicaciones_model->update($data_post,  $idubicacion);
					if( $services_id ) {
						$this->session->set_flashdata('log_success','Se actualizó la ubicación correctamente.');
						redirect( base_url().'admin/ubicaciones');
					}
					$data['errors'] = 'Ocurrió un error al actualizar la ubicación.';
					$data_post['is_submitted'] = 1;
					$data_post['submit'] = 1;
				}
			}
		}

		$data['ubicacion'] = $this->Ubicaciones_model->getRows( $idubicacion );
		$data['title'] = 'Editar ubicación';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/editar_ubicacion', $data);
		$this->load->view('admin/footer');
	}
	public function registrar( ) {
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
					'field' => 'address',
					'label' => 'Dirección',
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
						$data_post['slug'] = url_title($data_post['name'], 'dash', true);
						$services_id = $this->Ubicaciones_model->insert($data_post);
						if( $services_id ) {
							$this->session->set_flashdata('log_success','Se actualizó la ubicación correctamente.');
							redirect( base_url().'admin/ubicaciones');
						}
						$data['errors'] = 'Ocurrió un error al actualizar la ubicación.';
						$data_post['is_submitted'] = 1;
						$data_post['submit'] = 1;
					}
				} else {
					$data_post = $this->security->xss_clean($_POST);
					unset( $data_post['submit'] );
					unset( $data_post['is_submitted'] );

					$data_post['slug'] = url_title($data_post['name'], 'dash', true);
					$services_id = $this->Ubicaciones_model->insert($data_post);
					if( $services_id ) {
						$this->session->set_flashdata('log_success','Se actualizó la ubicación correctamente.');
						redirect( base_url().'admin/ubicaciones');
					}
					$data['errors'] = 'Ocurrió un error al actualizar la ubicación.';
					$data_post['is_submitted'] = 1;
					$data_post['submit'] = 1;
				}
			}
		}

		$data['ubicacion'] = array();
		$data['title'] = 'Registrar ubicación';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/registrar_ubicacion', $data);
		$this->load->view('admin/footer');
	}
}
