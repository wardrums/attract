<?php
class Shots_users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_users($shot_id)
	{
					
		$this->db->select('shots_users.user_id, users.first_name, users.last_name'); 
	    $this->db->from('shots_users');
		$this->db->join('users', 'users.id = shots_users.user_id', 'left');
		$this->db->where('shots_users.shot_id', $shot_id); 
	    $query = $this->db->get();
			
		//print_r ($query->result_array());

		return $query->result_array();
	}
	
	function set_user($shot_id, $user_id)
	{	
		$data = array(
			'user_id' => $user_id,
			'shot_id' => $shot_id
		);

		$shot_exists = $this->db->get_where('shots_users', $data);
		$shot_exists = $shot_exists->row();
		
		if (empty($shot_exists)) {
			return $this->db->insert('shots_users', $data);
		}
		
		//$this->db->where('shot_id', $shot_id);
		//return $this->db->update('shots_users', $data);
		return;
	}
	
	function remove_user($shot_id, $user_id)
	{
		$data = array(
			'user_id' => $user_id,
			'shot_id' => $shot_id
		);
		
		$shot_exists = $this->db->get_where('shots_users', $data);
		$shot_exists->row();
		
		if ($shot_exists) {
			return $this->db->delete('shots_users', $data);
		}
	}
	
	function set_users($shot_id)
	{
		
		$new_users_id = $this->input->post('shot_owners');	
		
		if ($new_users_id == '')
		{
			$new_users_id = array();
		}
		
		$this->db->select('shots_users.user_id'); 
	    $this->db->from('shots_users');
		$this->db->where('shot_id', $shot_id);
		$query = $this->db->get();
		
		$old_users_id = $query->result_array();
		$old_users_id_clean = array();
		
		// we make a list of the old user ids (by pusing them in a temp array)
		foreach ($old_users_id as $entry)
		{
			array_push($old_users_id_clean, $entry['user_id']);			
		}

		$old_users_id = $old_users_id_clean;
		//print('old_users_id -> ');
		//print_r ($old_users_id);
		
		//print('<br>new_users_id -> ');
		//print_r ($new_users_id);
		
		// we check which users id are actually new by comparing them with the current one
		$new_users_id_diff = array_diff($new_users_id, $old_users_id);
		
		//print('<br>array_diff -> ');
		//print_r ($new_users_id);
		
		// we assign those new users to the list
		foreach ($new_users_id_diff as $user_id) 
		{
			$this->set_user($shot_id, $user_id);
		}
		//print_r ($new_users_id);
		$removed_users_id = array();
		
		foreach ($old_users_id as $user_id) 
		{
			if (!in_array($user_id, $new_users_id)) {
				array_push($removed_users_id, $user_id);
			}
		}
		
		//print('<br>removed_users -> ');
		//print_r ($removed_users_id);
		
		foreach ($removed_users_id as $user) 
		{
			$this->remove_user($shot_id, $user);
		}
		
		return;
		
	}

}

