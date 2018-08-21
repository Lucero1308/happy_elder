<?php
class Events extends CI_Model{
	public $table = 'events';
	public $primary_key = 'events.id';
	function __construct(){
		parent::__construct();
	}

	function getRows($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id));
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
	public function delete($id){
		$delete = $this->db->delete($this->table,array( $this->primary_key =>$id));
		return $delete?true:false;
	}


	public function checkUser($data) {
		$st = $this->db->SELECT('*')->from('users')
			->WHERE('username',$data['username'])
			->WHERE('password',sha1(md5($data['password'])))
			->get()->result_array();
		if(count($st)>0) {
			return $st[0];
		}
		else {
			return false;
		}
	}
	public function checkPassword($str) {
		$st=$this->db->SELECT('*')->from('users')
			->WHERE( $this->primary_key ,$this->session->userdata[ $this->primary_key ])
			->WHERE('password',sha1(md5($str)))
			->get()->result_array();
		if(count($st)>0) {
			return true;
		}
		else {
			return false;
		}
	}
	public function updatePassword($password,$id) {
		$pass=array(
			'password' => sha1(md5($password))
		);
		$this->db->WHERE( $this->primary_key ,$id)->update('users',$pass);
	}
	public function register($data) {
		$data=$this->security->xss_clean($data);
		$user=array(
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => sha1(md5($data['password'])),
			'fullname' => $data['fullname'],
			'hash' => sha1(md5($this->session->userdata['session_id']))
		);
		$this->db->insert('users',$user);
		return $this->db->insert_id();
	}
	public function activateAccount($id,$hash) {
		$st=$this->db->select('*')->from('users')->WHERE( $this->primary_key ,$id)->WHERE('hash',$hash)->get()->row();
		if($st) {
			$status=array(
				'status' => 'approved'
			);
			$this->db->WHERE( $this->primary_key ,$id)->WHERE('users',$status);
			return true;
		}
		else {
			return false;
		}
	}
}