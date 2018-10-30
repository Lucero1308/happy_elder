<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Reportes_model');
		$this->validate_sesion();
	}
	public function index() {
		$data = array();
		$data['list'] = $this->Reportes_model->getRowsAdmin();
		$data['title'] = 'Reportes';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/reportes', $data);
		$this->load->view('admin/footer');
		
	}
	public function generar() {
		$data = array();
		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'type',
					'label' => 'Tipo',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'date_from',
					'label' => 'Desde',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'date_to',
					'label' => 'Hasta',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'formato',
					'label' => 'Formato',
					'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				$data_post = $this->security->xss_clean($_POST);
				$generate_file = false;
				$this->load->library('excel');
				$time = time();
				$file_name = 'reporte_'.$time.'.'.$data_post['formato'];
				$data_post['url'] = 'http://happyelder.pe/uploads/'.$file_name;
				switch ( $data_post['type'] ) {
					case 'valoracion':
						$this->load->model('Usuarios_model');
						$list = $this->Usuarios_model->get_valoracion_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $data_post['formato'] == 'pdf' ) {
							
						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'rol' => 'Rol',
									'val' => 'Calificaciones',
									'avg' => 'Promedio',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
										'index' => $key + 1,
										'name' => $lt['nombre'],
										'rol' => $lt['rol'],
										'val' => $lt['total'],
										'avg' => $lt['avg'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Reporte de valoracion');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
							$objWriter->save( 'uploads/'.$file_name );
								
						}
						$generate_file = true;
						break;
					case 'servicios':
						$this->load->model('Servicios_model');
						$list = $this->Servicios_model->getServiciosReporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $data_post['formato'] == 'pdf' ) {

						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'val' => 'Valor',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
										'index' => $key + 1,
										'name' => $lt['nombre'],
										'val' => $lt['total'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Reporte de servicios');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
					
							$objWriter->save( 'uploads/'.$file_name );
						}
						$generate_file = true;
						break;
					case 'cuentas':
						$this->load->model('Usuarios_model');
						$list = $this->Usuarios_model->get_usuarios_reporte( $data_post['date_from'], $data_post['date_to'] );

						if ( $data_post['formato'] == 'pdf' ) {

						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'val' => 'Valor',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
										'index' => $key + 1,
										'name' => $lt['nombre'],
										'val' => $lt['total'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Reporte de cuentas');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
					
							$objWriter->save( 'uploads/'.$file_name );
						}
						$generate_file = true;
						break;
					case 'eventos':
						$this->load->model('Eventos_model');
						$list = $this->Eventos_model->getEventosReporte( $data_post['date_from'], $data_post['date_to'] );

						if ( $data_post['formato'] == 'pdf' ) {

						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'val' => 'Valor',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
										'index' => $key + 1,
										'name' => $lt['nombre'],
										'val' => $lt['total'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Reporte de eventos');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
					
							$objWriter->save( 'uploads/'.$file_name );
						}
						$generate_file = true;
						break;
					
					default:
						$data['errors'] = 'No existe ese tipo de reporte.';
						break;
				}
				if( $generate_file ) {
					unset( $data_post['is_submitted'] );
					$reporte_id = $this->Reportes_model->insert($data_post);
					if( $reporte_id ) {
						$this->session->set_flashdata('log_success','Se creó el reporte correctamente.');
						redirect( base_url().'admin/reportes');
					}
				}
				$data['errors'] = 'Ocurrió un error al generar el reporte.';
			}
		}
		$data['title'] = 'Generar reporte';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/generar_reporte', $data);
		$this->load->view('admin/footer');
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
	public function eliminar() {
		$id=$this->uri->segment(4);
		$check=$this->Reportes_model->update( array( 'status' => 'trash' ), $id);
		if($check) {
			$this->session->set_flashdata('log_success','Reporte eliminado correctamente');
		}
		else {
			$this->session->set_flashdata('log_error','Ocurruó un error al eliminar el reporte');
		}
		redirect(base_url().'admin/reportes');
	}
}
