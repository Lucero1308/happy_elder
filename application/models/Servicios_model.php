<?php
class Servicios_model extends CI_Model{
	public $table = 'services';
	public $primary_key = 'services.id';
	public $status = 'services.status';
	function __construct(){
		parent::__construct();
	}
	function getRows($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status . ' !=' => 'trash' ));
			return $query->row_array();
		}else{
			$query = $this->db->get_where($this->table, array( $this->status => 'publish' ));
			return $query->result_array();
		}
	}
	function exist($slug = ""){
		if(!empty($slug)){
			$query = $this->db->get_where($this->table, array( 'services.slug' => $slug ) );
			return $query->row_array();
		}else{
			return array();
		}
	}
	function getRowBySlug($slug = ""){
		if(!empty($slug)){
			$query = $this->db->get_where($this->table, array( 'services.slug' => $slug, $this->status => 'publish' ));
			return $query->row_array();
		}else{
			return array();
		}
	}
	function getRowsByUser($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( 'services.user_id' => $id, $this->status . ' !=' => 'trash' ));
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