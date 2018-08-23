<?php
class Usuarios_model extends CI_Model{
	public $table = 'users';
	public $primary_key = 'users.id';
	public $status = 'users.status';
	function __construct(){
		parent::__construct();
	}
	function getRows($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id ));
			return $query->row_array();
		}else{
			$query = $this->db->get($this->table);
			return $query->result_array();
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