<?php
class Shots_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_shots($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('shots');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('shots', array('id' => $id));
		return $query->row_array();
	}
}

