<?php

class Model_comments extends CI_Model {
	function add_comment($data) { //añadir comentarios
		$this->db->insert('comments',$data);
		return $this->db->insert_id();
	}
	function update_coment($data, $id) { // cambiar estado - eliminacion logica
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('comments', $data, array( 'comments.comment_id' =>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}
	function get_comments($post_id) { //jalar los comentarios -listarlos
		$this->db->select('comments.*,usuarios.userName,usuarios.fullName, usuarios.photo as photoUser');
		$this->db->from('comments');
		$this->db->join('usuarios','usuarios.id = comments.user_id', 'left');
		$this->db->where('post_id',$post_id);
		$this->db->where('comments.status', 'publish' );
		$this->db->order_by('date_added','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
}

