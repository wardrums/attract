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
					
			$this->db->select(' shots.id, shots.name, shots.description'); 
			$this->db->select('GROUP_CONCAT(shot_users.user_id SEPARATOR ",") as user_id', FALSE); 
			$this->db->select('GROUP_CONCAT(users.first_name SEPARATOR ",") as user_first_name', FALSE);
		    $this->db->from('shots');
		   	$this->db->join('shot_users', 'shot_users.shot_id = shots.id');
			$this->db->join('users', 'users.id = shot_users.user_id', 'left');
			$this->db->group_by('shots.name'); 
		    $query = $this->db->get(); 
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		$query = $this->db->get_where('shots', array('id' => $id));
		return $query->row_array();
	}
}

