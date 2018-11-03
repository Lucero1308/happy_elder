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
	function get_enfermeras(){
		$this->db->select('usuarios.*, roles.name as rolName, SUM(CASE WHEN ( comments.status = \'publish\' ) THEN 1 ELSE 0 END) as count, SUM(CASE WHEN ( comments.val != 0 && comments.status = \'publish\' ) THEN 1 ELSE 0 END) as total_cal, avg(CASE WHEN comments.val != 0 && comments.status = \'publish\' THEN comments.val ELSE null END) as avg_comment');
		$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
		$this->db->join('comments', 'comments.post_id = usuarios.id', 'LEFT');
		$this->db->group_by('usuarios.id');
		$query = $this->db->get_where($this->table, array(  $this->status => 'approved', 'rol' => 4 ));
		return $query->result_array();
	}
	function get_valoracion_reporte( $from, $to ){
		$this->db->select('date_added, YEAR(date_added) anho, MONTH(date_added) as mes, post_id, usuarios.fullName as nombre, roles.name as rol, SUM(CASE WHEN ( comments.val != 0 && comments.status = \'publish\' ) THEN 1 ELSE 0 END) as total, avg(CASE WHEN comments.val != 0 && comments.status = \'publish\' THEN comments.val ELSE null END) as avg');
		$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
		$this->db->join('comments', 'comments.post_id = usuarios.id', 'LEFT');
		$this->db->where('date_added >=', $from.' 00:00:00');
		$this->db->where('date_added <=', $to.' 23:59:59' );
		$this->db->where('comments.val != ', 0 );
		$this->db->where('comments.status', 'publish' );
		$this->db->group_by('usuarios.id');
		//$this->db->group_by('YEAR(date_added)');
		//$this->db->group_by('MONTH(date_added)');
		//$this->db->order_by('YEAR(date_added) asc');
		//$this->db->order_by('MONTH(date_added) asc');
		$query = $this->db->get_where($this->table, array(  $this->status => 'approved', 'comments.val !=' => 0 ));
		return $query->result_array();
	}

	function get_usuarios_reporte( $from, $to ){
		$this->db->select('usuarios.*, ubicaciones.name as location, count(usuarios.id) as total');
		$this->db->where('fechaVisita >=', $from.' 00:00:00');
		$this->db->where('fechaVisita <=', $to.' 23:59:59' );
		$this->db->where('usuarios.rol', 4 );
		$this->db->where('usuarios.status', 'approved' );
		$this->db->where('beneficiarios.status', 'asignado' );
		$this->db->group_by('usuarios.id');
		$this->db->group_by('beneficiarios.location_id');
		$this->db->join('usuarios', 'usuarios.id = beneficiarios.user_id', 'LEFT');
		$this->db->join('ubicaciones', 'ubicaciones.id = beneficiarios.location_id', 'LEFT');
		$query = $this->db->get('beneficiarios');
		return $query->result_array(); 
	}

	function get_enfermeras_busca($texto=''){
		$this->db->select('usuarios.*, roles.name as rolName, SUM(CASE WHEN ( comments.status = \'publish\' ) THEN 1 ELSE 0 END) as count, SUM(CASE WHEN ( comments.val != 0 && comments.status = \'publish\' ) THEN 1 ELSE 0 END) as total_cal, avg(CASE WHEN comments.val != 0 && comments.status = \'publish\' THEN comments.val ELSE null END) as avg_comment');
		$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
		$this->db->join('comments', 'comments.post_id = usuarios.id', 'LEFT');
		$this->db->group_by('usuarios.id');
		$query = $this->db->get_where($this->table, array(  $this->status => 'approved', 'rol' => 4 , "fullName like " => '%'.$texto.'%' ));
		if ($query->num_rows()>0) {
			return $query->result_array();
		}else{
			return false;
		}
	}

	function get_voluntarios(){
		$this->db->select('usuarios.*, roles.name as rolName, SUM(CASE WHEN ( comments.status = \'publish\' ) THEN 1 ELSE 0 END) as count, SUM(CASE WHEN ( comments.val != 0 && comments.status = \'publish\' ) THEN 1 ELSE 0 END) as total_cal, avg(CASE WHEN comments.val != 0 && comments.status = \'publish\' THEN comments.val ELSE null END) as avg_comment');
		$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
		$this->db->join('comments', 'comments.post_id = usuarios.id', 'LEFT');
		$this->db->group_by('usuarios.id');
		$query = $this->db->get_where($this->table, array(  $this->status => 'approved', 'rol' => 3 ));
		return $query->result_array(); 
	}


	function get_voluntarios_busca($texto=''){

		$this->db->select('usuarios.*, roles.name as rolName, SUM(CASE WHEN ( comments.status = \'publish\' ) THEN 1 ELSE 0 END) as count, SUM(CASE WHEN ( comments.val != 0 && comments.status = \'publish\' ) THEN 1 ELSE 0 END) as total_cal, avg(CASE WHEN comments.val != 0 && comments.status = \'publish\' THEN comments.val ELSE null END) as avg_comment');
		$this->db->join('roles', 'roles.role_id = usuarios.rol', 'LEFT');
		$this->db->join('comments', 'comments.post_id = usuarios.id', 'LEFT');
		$this->db->group_by('usuarios.id');	
		$query = $this->db->get_where($this->table, array(  $this->status => 'approved', 'rol' => 3 , "fullName like " => '%'.$texto.'%'));
		if ($query->num_rows()>0) {
			return $query->result_array();
		}else{
			return FALSE;
		} // si el resultado es mayor que 0 que me lo imprima , sino no
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
	
	public function checkUser($data) { //validar el inicio de sesión
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
