<?php
class Tape_model extends CI_Model {
	
	var $table = 'tape';

	public function tape_add($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


	 public function get_all_tape(){
	 	$this->db->from('tape');
	 	$query = $this->db->get();
	 	return $query->result();
	 }


	 public function get_by_id($id) {
	 	$this->db->from($this->table);
	 	$this->db->where('tape_id', $id);
	 	$query = $this->db->get();

	 	return $query->row();
	 }


	 public function tape_update($where, $data){
	 	$this->db->update($this->table, $data, $where);
	 	return $this->db->affected_rows();
	 }

	 public function delete_by_id($id) {
		$this->db->where('tape_id', $id);
		$this->db->delete($this->table);
	}
	
}

?>