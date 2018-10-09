<?php
class Ubicaciones_model extends CI_Model{

	public $table = 'ubicaciones';
	public $primary_key = 'ubicaciones.id';
	public $status = 'ubicaciones.status';

	function getRows($id = ""){
		if(!empty($id)){
			$query = $this->db->get_where($this->table, array( $this->primary_key => $id, $this->status => 'publish' ));
			return $query->row_array();
		}else{
			$query = $this->db->get_where($this->table, array( $this->status => 'publish' ));
			return $query->result_array();
		}
	}
	function exist($slug = "", $id = ""){
		if(!empty($slug)){
			$query = $this->db->get_where($this->table, array( 'ubicaciones.slug' => $slug, $this->primary_key . ' !=' => $id ));
			return $query->row_array();
		}else{
			return array();
		}
	}
	function getRowBySlug($slug = ""){
		if(!empty($slug)){
			$query = $this->db->get_where($this->table, array( 'ubicaciones.slug' => $slug, $this->status => 'publish' ));
			return $query->row_array();
		}else{
			return array();
		}
	}
	function getBeneficiarios($location_id, $beneficiario_id = ''){
		if(!empty($location_id)){
			if(!empty($beneficiario_id)){
				$query = $this->db->get_where('beneficiarios', array( 'id' => $beneficiario_id, 'location_id' => $location_id, 'status' => 'libre' ));
				return $query->row_array();
			}else{
				$query = $this->db->get_where('beneficiarios', array( 'location_id' => $location_id, 'status' => 'libre' ));
				return $query->result_array();
			}
			
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
	public function insertBeneficiario($data = array()) {
		$insert = $this->db->insert('beneficiarios', $data);
		if($insert){
			return $this->db->insert_id();
		} else{
			return false;
		}
	}
	public function updateBeneficiario($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('beneficiarios', $data, array( 'id' =>$id));
			return $update?true:false;
		}else{
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

	function getRowsByUser($id = "", $beneficiario_id = ''){

			if(!empty($beneficiario_id) && !empty($id)){
				$query = $this->db->get_where('beneficiarios', array( 'usuarios.user_id' => $id,'id' => $beneficiario_id,  'status' => 'asignado' ));
				return $query->result_array();
			}else{
				return array();
			}
	



}
}


