<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('Servicios_model');
	}
	public function index() {
		$data = array();
		$data['title'] = 'Servicios';
		$data['posts'] = $this->Servicios_model->getRows();
		$this->load->view('header', $data);
		$this->load->view('lists_services', $data);
		$this->load->view('footer');
	}

	public function ver( $slug ) {
		$data['servicio'] = $this->Servicios_model->getRowBySlug($slug);
		$data['title'] = '';
		if ( $data['servicio'] ) {
			$data['title'] = $data['servicio']['name'];
		}
		$this->load->view('header', $data);
		$this->load->view('ver_servicio', $data);
		$this->load->view('footer');
	}
	public function isLoggedin() {
		if(!empty($this->session->userdata['id'])) {
			return true;
		}
		else {
			return false;
		}
	}
	public function reservar( $slug ) {
		if( $this->isLoggedin() ) { 
			$data['servicio'] = $this->Servicios_model->getRowBySlug($slug);
			$data['title'] = 'Reservar servicio';
			if ( $data['servicio'] ) {
				if ( isset( $_POST ) && count( $_POST ) ) {
					$config = array(
						array(
							'field' => 'visitanteFecha',
							'label' => 'Fecha de servicio',
							'rules' => 'trim|required'
						),
					);
					$this->form_validation->set_rules($config);
					if ($this->form_validation->run() == false) {
						$data['errors'] = validation_errors();
					} else {
						$data_post = $this->security->xss_clean($_POST);
						$data_post['visitante_id'] = $this->session->userdata['id'];
						unset( $data_post['is_submitted'] );
						$data_post['status'] = 'reservado';
						$servicio_id = $this->Servicios_model->update($data_post, $data['servicio']['id'] );
						if( $servicio_id ) {
							$this->session->set_flashdata('log_success','Se reservó correctamente el servicio.');
							redirect( base_url().'servicios');
						}
						$data['errors'] = 'Ocurrió un error al reservar el servicio.';
						$data_post['is_submitted'] = 1;
					}
				}
			} else {
				$data['title'] = 'Servicio no disponible';
			}
			$this->load->view('header', $data);
			$this->load->view('reservar_servicio', $data);
			$this->load->view('footer');
		} else {
			redirect( base_url() );
		}
	}
}
