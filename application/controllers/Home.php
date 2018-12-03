<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->model('Servicios_model');
			$this->load->model('Eventos_model');
			$this ->load ->library ('unit_test'); //Se agrega libreria
	}
	public function index() {
		$data['title'] = 'Inicio';
		
		$this->load->view('header', $data);

		$data['posts'] = $this->Servicios_model->getRows();
		$this->load->view('lists_services', $data);

		$data['posts'] = $this->Eventos_model->getRows();
		$this->load->view('lists_events', $data);

		$this->load->view('footer');
	}

	public function pruebaHome(){
		$data['title'] = 'Prueba Home';
		$result  ='is_array'; //tipos de resultado
		$result2  ='is_null';//tipos de resultado
		$nombre='Prueba Home';
		$data['pruebita']=$this->unit->run($this->Eventos_model->getRows(),$result, $nombre, 'Pruebas unitarias - Recojer datos de la funcion Index - Servicios'); //prueba unitaria 1
		$data['pruebas']=$this->unit->run($this->Eventos_model->getRows(),$result, $nombre, 'Pruebas unitarias - Recojer datos de la funcion Index - Eventos');//prueba unitaria 2
		$data['prueba']=$this->unit->run($this->index(),$result2, $nombre, 'Pruebas unitarias - No se muestra datos en el mismo controlador - Se muestra en la vista - Método Index');//prueba unitaria 3
		$this->load->view('header', $data);
		$this->load->view('pruebas', $data);
		$this->load->view('footer');
	}

}
