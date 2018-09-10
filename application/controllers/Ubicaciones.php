<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubicaciones extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('Ubicaciones_model');
	}
	public function index() {
		$data = array();
		$data['title'] = 'Ubicaciones';
		$data['posts'] = $this->Ubicaciones_model->getRows();
		$this->load->view('header', $data);
		$this->load->view('lists_locations', $data);
		$this->load->view('footer');
	}

	public function ver( $slug ) {
		$data['ubicacion'] = $this->Ubicaciones_model->getRowBySlug($slug);
		$data['title'] = '';
		if ( $data['ubicacion'] ) {
			$data['title'] = $data['ubicacion']['name'];
		}
		$this->load->view('header', $data);
		$this->load->view('ver_ubicacion', $data);
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

	public function seleccionar( $slug_ubicacion ) {
		if( $this->isLoggedin() ) { 
			$data['ubicacion'] = $this->Ubicaciones_model->getRowBySlug($slug_ubicacion);
			
			$data['title'] = 'Seleccionar beneficiario';
			if ( $data['ubicacion'] ) {
				$data['beneficiarios'] = $this->Ubicaciones_model->getBeneficiarios($data['ubicacion']['id']);
				if( $data['beneficiarios'] ) {
					$data['beneficiario'] = $data['beneficiarios'][ rand( 0, count( $data['beneficiarios'] ) - 1 ) ]; //asignacion automatica
					if ( isset( $_POST ) && count( $_POST ) ) {
						$config = array(
							array(
								'field' => 'beneficiario_id',
								'label' => 'Beneficiario',
								'rules' => 'trim|required'
							),
							array(
								'field' => 'fechaVisita',
								'label' => 'Fecha de visita',
								'rules' => 'trim|required'
							),
						);
						$this->form_validation->set_rules($config);
						if ($this->form_validation->run() == false) {
							$data['errors'] = validation_errors();
							$data_post = $this->security->xss_clean($_POST);
							$beneficiario_id = $data_post['beneficiario_id'];
							$data['beneficiario'] = $this->Ubicaciones_model->getBeneficiarios($data['ubicacion']['id'], $beneficiario_id);
						} else {
							$data_post = $this->security->xss_clean($_POST);
							$beneficiario_id = $data_post['beneficiario_id'];
							$data['beneficiario'] = $this->Ubicaciones_model->getBeneficiarios($data['ubicacion']['id'], $beneficiario_id);
							unset( $data_post['submit'] );
							unset( $data_post['is_submitted'] );
							unset( $data_post['beneficiario_id'] );
							$data_post['status'] = 'asignado';
							$data_post['user_id'] = $this->session->userdata['id'];
							$beneficiario_id = $this->Ubicaciones_model->updateBeneficiario($data_post,  $beneficiario_id);
							if( $beneficiario_id ) {
								$this->session->set_flashdata('log_success','Se asignó correctamente al beneficiario.');
								redirect( base_url().'ubicaciones');
							}
							$data['errors'] = 'Ocurrió un error al asignar al beneficairio.';
							$data_post['is_submitted'] = 1;
							$data_post['submit'] = 1;
							$data_post['beneficiario_id'] = $beneficiario_id;
						}
					}
				} else {
					$data['errors'] = 'La ubicación no tiene beneficiarios disponibles.';
				}
			} else {
				$data['title'] = 'No existe la ubicación';
			}

			$this->load->view('header', $data);
			$this->load->view('seleccionar_beneficiario', $data);
			$this->load->view('footer');
		} else {
			redirect( base_url() );
		}
	}
}
