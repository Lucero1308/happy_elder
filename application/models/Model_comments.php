<?php

class Model_comments extends CI_Model {
	function add_comment($data) {
		$this->db->insert('comments',$data);
		return $this->db->insert_id();
	}
	function get_comments($post_id) {
		$this->db->select('comments.*,usuarios.userName,usuarios.fullName, usuarios.photo as photoUser');
		$this->db->from('comments');
		$this->db->join('usuarios','usuarios.id = comments.user_id', 'left');
		$this->db->where('post_id',$post_id);
		$this->db->order_by('date_added','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
}

