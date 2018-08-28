<?php
class Usuarios_model extends CI_Model{
	public $table = 'users';
	public $primary_key = 'users.id';
	public $status = 'users.status';
	function __construct(){
		parent::__construct();
	}
	function getRoles(){
		$query = $this->db->get('roles');
		return $query->result_array();
	}
	function getRows($id = ""){
		if(!empty($id)){
			$this->db->select('users.*, roles.name as rolName');
			$this->db->join('roles', 'roles.role_id = users.rol', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status => 'approved' ));
			return $query->row_array();
		}else{
			$this->db->select('users.*, roles.name as rolName');
			$this->db->join('roles', 'roles.role_id = users.rol', 'LEFT');
			$query = $this->db->get_where($this->table, array(  $this->status => 'approved' ));
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
			if($update){
				return true;
			}else{
				print_r( $this->db->_error_messag );
				exit();
				return $this->db->_error_message(); 
			}
		}else{
			return false;
		}
	}
}