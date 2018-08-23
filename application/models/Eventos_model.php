<?php
class Eventos_model extends CI_Model{
	public $table = 'events';
	public $primary_key = 'events.id';
	public $status = 'events.status';
	function __construct(){
		parent::__construct();
	}
	function getRows($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status => 'publish' ));
			return $query->row_array();
		}else{
			$query = $this->db->get_where($this->table, array( $this->status => 'publish' ));
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