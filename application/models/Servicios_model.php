<?php
class Servicios_model extends CI_Model{
	public $table = 'servicios';
	public $primary_key = 'servicios.id';
	public $status = 'servicios.status';

	function getRows($id = ""){ // filas
		if(!empty($id)){
			$this->db->select('servicios.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = servicios.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status . ' !=' => 'trash' ));
			return $query->row_array();
		}else{
			$this->db->select('servicios.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = servicios.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->status => 'publish' ));
			return $query->result_array(); // retorna un array de cada fila o de la consulta
		}
	}
	function getRowsAdmin($id = ""){ // filas
		if(!empty($id)){
			$this->db->select('servicios.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = servicios.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status . ' !=' => 'trash' ));
			return $query->row_array();
		}else{
			$this->db->select('servicios.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = servicios.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->status . ' !=' => 'trash' ));
			return $query->result_array(); // retorna un array de cada fila o de la consulta
		}
	}
	function getServiciosReporte( $from, $to ){ // filas
		$this->db->select('servicios.*, count( servicios.id ) as count');
		$this->db->where('dateCreate >=', $from.' 00:00:00');
		$this->db->where('dateCreate <=', $to.' 23:59:59' );
		$this->db->group_by('status');
		$query = $this->db->get_where($this->table, array( $this->status . ' !=' => 'trash' ));
		return $query->result_array(); // retorna un array de cada fila o de la consulta
	}
	function exist($slug = "", $id = ""){
		if(!empty($slug)){// para ver si existe 
			$query = $this->db->get_where($this->table, array( 'servicios.slug' => $slug, $this->primary_key . ' !=' => $id ) );
			return $query->row_array(); // retorna todos los datos - retorna una fila
		}else{
			return array();
		}
	}
	function getCountTypes(){
		$this->db->select('COUNT(status) as count, status as rolName');
		$this->db->distinct();
		$this->db->group_by('status');
		$query = $this->db->get( $this->table );
		return $query->result_array(); 
	}
	function getRowBySlug($slug = ""){
		if(!empty($slug)){
			$this->db->select('servicios.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = servicios.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( 'servicios.slug' => $slug, $this->status => 'publish' ));
			return $query->row_array();
		}else{
			return array();
		}
	}
	function getRowsByUser($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( 'servicios.user_id' => $id, $this->status . ' !=' => 'trash' ));
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function insert($data = array()) {
		$insert = $this->db->insert($this->table, $data);
		if($insert){
			return $this->db->insert_id();
		} else{
			return false;
		}
	}
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update($this->table, $data, array( $this->primary_key =>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}
}