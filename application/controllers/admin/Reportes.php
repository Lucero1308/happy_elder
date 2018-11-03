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

		$data['title'] = 'Generar reporte';
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
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				$data_post = $this->security->xss_clean($_POST);
				$meses = array(
					'1' => 'Enero',
					'2' => 'Febrero',
					'3' => 'Marzo',
					'4' => 'Abril',
					'5' => 'Mayo',
					'6' => 'Junio',
					'7' => 'Julio',
					'8' => 'Agosto',
					'9' => 'Septiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre',
				);
				$data_graf = array();
				switch ( $data_post['type'] ) {
					case 'valoracion':
						$this->load->model('Usuarios_model');
						$list = $this->Usuarios_model->get_valoracion_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								if ( !isset( $data_graf[$lt['anho'].$lt['mes']] ) ) {
								}
								$data_graf[] = array(
									'name' =>  $lt['nombre'],
									'total' => $lt['avg'],
								); 
							}
						}
						break;
					case 'servicios':
						$this->load->model('Servicios_model');
						$list = $this->Servicios_model->getServiciosReporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								if ( !isset( $data_graf[$lt['visitante_id']] ) ) {
									$data_graf[$lt['visitante_id']] = array(
										'name' =>  $lt['usuario'],
										'total' => 0,
									); 
								}
								$data_graf[$lt['visitante_id']]['total']++;
							}
						}
						break;
					case 'cuentas':
						$this->load->model('Usuarios_model');
						$list = $this->Usuarios_model->get_usuarios_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								if ( !isset( $data_graf[$lt['id']] ) ) {
									$data_graf[$lt['id']] = array(
										'name' =>  $lt['fullName'],
										'total' => 0,
									); 
								}
								$data_graf[$lt['id']]['total']++;
							}
						}
						break;
					case 'eventos':
						$this->load->model('Eventos_model');
						$list = $this->Eventos_model->getEventosReporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								$data_graf[] = array(
									'name' =>  $lt['name'],
									'total' => $lt['donaciones'],
								); 
							}
						}
						break;
				}
				//$data['data_graf_2'] = $data_graf_2;
				$data['data_graf'] = $data_graf;
				$data['list'] = $list;
				//$data['list_2'] = $list_2;
				$data['data_post'] = $data_post;
				
				$this->load->view('admin/header', $data);
				$this->load->view('admin/reporte', $data);
				$this->load->view('admin/footer');
				return;
			}

		}
		$this->load->view('admin/header', $data);
		$this->load->view('admin/generar_reporte', $data);
		$this->load->view('admin/footer');
		/*

		$data = array();
		$data['list'] = $this->Reportes_model->getRowsAdmin();
		$data['title'] = 'Reportes';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/reportes', $data);
		$this->load->view('admin/footer');
		
		*/
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
