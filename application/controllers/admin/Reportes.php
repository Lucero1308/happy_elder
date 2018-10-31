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
	private function procesing_data( $data, $name ) {
		$list = array();
		if ( $data && count( $data ) ) {
			$list[0] = array();
			foreach ($data as $key => $dt) {
				$list[0][] = $dt[ $name ];
			}
		}
		return $list;
	}
	private function pdf_generate( $html, $name_view ) {
		$this->load->helper( array( 'dompdf', 'file' ) );
		$pdf_string = pdf_create($html, '', false);
		file_put_contents( './uploads/'.$name_view.'.pdf', $pdf_string ); 
	}
	private function jpg_generate_bar( $title, $data, $name_view ) {
		require_once (APPPATH.'/libraries/JpGraph/jpgraph.php');
		require_once (APPPATH.'/libraries/JpGraph/jpgraph_bar.php');

		$graph = new Graph(350,200,'auto');
		$graph->SetScale("textlin");

		$theme_class=new UniversalTheme;
		$graph->SetTheme($theme_class);

		$graph->SetBox(false);

		$graph->ygrid->SetFill(false);
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

		if ( $data && count( $data ) ) {
			$list_BarPlot = [];
			foreach ($data as $key => $dt) {
				$b1plot = new BarPlot($dt);
				$list_BarPlot[] = $b1plot;
			}
		}

		$gbplot = new GroupBarPlot( $list_BarPlot );
		$graph->Add($gbplot);
		var_dump( $title );
		$graph->title->Set( $title );

		$graph->Stroke( 'uploads/'.$name_view.'.jpg' );
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
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://happyelder.pe/uploads/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
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
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://happyelder.pe/uploads/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
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
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://happyelder.pe/uploads/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
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
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://happyelder.pe/uploads/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							echo $contenido;
							exit();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
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
