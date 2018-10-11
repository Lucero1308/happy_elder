<?php
class Usuarios_model extends CI_Model{
	public $table = 'usuarios';
	public $primary_key = 'usuarios.id';
	public $status = 'usuarios.status';

	function getRoles(){
		$query = $this->db->get('roles');
		return $query->result_array();
	}
	function getRows($id = ""){
		if(!empty($id)){
			$this->db->select('usuarios.*, roles.name as rolName');
			$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status => 'approved' ));
			return $query->row_array();
		}else{
			$this->db->select('usuarios.*, roles.name as rolName');
			$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
			$query = $this->db->get_where($this->table, array(  $this->status => 'approved' ));
			return $query->result_array();
		}
	}
	function getRowsAdmin($id = ""){
		if(!empty($id)){
			$this->db->select('usuarios.*, roles.name as rolName');
			$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status . ' != ' => 'trash' ));
			return $query->row_array();
		}else{
			$this->db->select('usuarios.*, roles.name as rolName');
			$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
			$query = $this->db->get_where($this->table, array(  $this->status . ' != ' => 'trash' ));
			return $query->result_array();
		}
	}
	function getCountTypes(){
		$this->db->select('COUNT(id) as count, roles.name as rolName');
		$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
		$this->db->distinct();
		$this->db->group_by('rol');
		$query = $this->db->get('usuarios');
		return $query->result_array(); 
	}
	function exist($userName = "", $id = ""){
		if(!empty($userName)){
			$query = $this->db->get_where($this->table, array( 'usuarios.userName' => $userName, $this->primary_key . ' !=' => $id ));
			return $query->row_array();
		}else{
			return array();
		}
	}
	function existbyHash($userName = ""){
		if(!empty($userName)){
			$query = $this->db->get_where($this->table, array( 'usuarios.hash' => $userName ) );
			return $query->row_array();
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
		} else {
			return false;
		}
	}
	
	public function checkUser($data) {
		$st=$this->db->SELECT('*')->from('usuarios')
			->WHERE('userName',$data['userName'])
			->WHERE('password',sha1(md5($data['password'])))
			->get()->result_array();
		if(count($st)>0) {
			return $st[0];
		}
		else {
			return false;
		}
	}
}