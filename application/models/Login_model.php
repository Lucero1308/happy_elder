<?php
class Login_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function getById($user_id) {
		$st=$this->db->SELECT('*')->from('users')
			->WHERE('id',$user_id)
			->get()->result_array();
		if(count($st)>0) {
			return $st[0];
		}
		else {
			return false;
		}
	}
	public function checkUserName($userName) {
		$st=$this->db->SELECT('*')->from('users')
			->WHERE('userName',$userName)
			->get()->result_array();
		if(count($st)>0) {
			return $st[0];
		}
		else {
			return false;
		}
	}
	public function checkUser($data) {
		$st=$this->db->SELECT('*')->from('users')
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
	public function register($data) {
		$data = $this->security->xss_clean($data);
		$user = array(
			'userName' => $data['userName'],
			'password' => sha1(md5($data['password'])),
			'firstName' => $data['firstName'],
			'lastName' => $data['lastName'],
			'status' => 'approved',
			'telephone' => $data['telephone'],
			'rol' => $data['rol'],
			'fullName' => $data['firstName'] . ' ' . $data['lastName'],
			'hash' => sha1(md5($this->session->userdata['session_id']))
		);
		$this->db->insert('users',$user);
		return $this->db->insert_id();
	}
}