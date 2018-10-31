<?php
class Eventos_model extends CI_Model{
	public $table = 'eventos';
	public $primary_key = 'eventos.id';
	public $status = 'eventos.status';

	function getRows($id = ""){
		if(!empty($id)){
			$this->db->select('eventos.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = eventos.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status => 'publish' ));
			return $query->row_array();
		}else{
			$this->db->select('eventos.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = eventos.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->status => 'publish' ));
			return $query->result_array();
		}
	}
	function exist($slug = "", $id = ""){
		if(!empty($slug)){
			$query = $this->db->get_where($this->table, array( 'eventos.slug' => $slug, $this->primary_key . ' !=' => $id ));
			return $query->row_array();
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
	function getEventosReporte( $from, $to ){
		$this->db->select('status as nombre, COUNT(status) as total');
		$this->db->distinct();
		$this->db->group_by('status');

		$this->db->select('eventos.*');
		$this->db->where('dateEvent >=', $from.' 00:00:00');
		$this->db->where('dateEvent <=', $to.' 23:59:59' );
		$query = $this->db->get_where($this->table, array(  ));
		return $query->result_array(); 
	}
	function getRowBySlug($slug = ""){
		if(!empty($slug)){
			$this->db->select('eventos.*, usuarios.fullName as usuario');
			$this->db->join('usuarios', 'usuarios.id = eventos.user_id', 'LEFT');
			$query = $this->db->get_where($this->table, array( 'eventos.slug' => $slug, $this->status => 'publish' ));
			return $query->row_array();
		}else{
			return array();
		}
	}
	function getRowsByUser($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( 'eventos.user_id' => $id, $this->status => 'publish' ));
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
	public function update($data, $id) { //eliminar
		if(!empty($data) && !empty($id)){
			$update = $this->db->update($this->table, $data, array( $this->primary_key =>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}
}