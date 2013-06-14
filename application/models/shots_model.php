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
					
			$this->db->select('shots.shot_id, shots.shot_name, shots.shot_description, shots.shot_duration'); 
			$this->db->select('shot_statuses.shot_status_name, shot_stages.shot_stage_name, shots.shot_notes'); 
			$this->db->select('GROUP_CONCAT(shots_users.user_id SEPARATOR ",") as user_id', FALSE); 
			$this->db->select('GROUP_CONCAT(users.first_name SEPARATOR ",") as user_first_name', FALSE);
		    $this->db->from('shots');
		   	$this->db->join('shots_users', 'shots_users.shot_id = shots.shot_id');
			$this->db->join('users', 'users.id = shots_users.user_id', 'left');
			$this->db->join('shot_statuses', 'shot_statuses.shot_status_id = shots.status_id', 'left');
			$this->db->join('shot_stages', 'shot_stages.shot_stage_id = shots.stage_id', 'left');
			$this->db->group_by('shots.shot_name'); 
			$this->db->order_by('shots.shot_order', 'asc');
		    $query = $this->db->get(); 
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		$this->db->select('shots.shot_id, shots.shot_name, shots.shot_description, shots.shot_duration, scenes.scene_id'); 
		$this->db->select('shot_statuses.shot_status_id, shot_statuses.shot_status_name, shot_stages.shot_stage_id, shot_stages.shot_stage_name, shots.shot_notes'); 
		$this->db->select('GROUP_CONCAT(shots_users.user_id SEPARATOR ",") as user_id', FALSE); 
		$this->db->select('GROUP_CONCAT(users.first_name SEPARATOR ",") as user_first_name', FALSE);
	    $this->db->from('shots');
	   	$this->db->join('shots_users', 'shots_users.shot_id = shots.shot_id');
		$this->db->join('users', 'users.id = shots_users.user_id', 'left');
		$this->db->join('scenes', 'scenes.scene_id = shots.scene_id', 'left');		
		$this->db->join('shot_statuses', 'shot_statuses.shot_status_id = shots.status_id', 'left');
		$this->db->join('shot_stages', 'shot_stages.shot_stage_id = shots.stage_id', 'left');
		$this->db->group_by('shots.shot_name'); 
		$this->db->where('shots.shot_id', $id); 
		$query = $this->db->get();
		
		return $query->row_array();
	}

	public function set_shots($id = FALSE)
	{
		if ($id === FALSE) 
		{
			$data = array(
				'shot_name' => $this->input->post('shot_name'),
				'shot_description' =>  $this->input->post('shot_description'),
				'scene_id' => $this->input->post('scene_id'),
				'shot_duration' => $this->input->post('shot_duration')
			);
			
			return $this->db->insert('shots', $data);
		} 
		else 
		{
			$shot_id = $this->input->post('shot_id');
			$data = array(
				'scene_id' => $this->input->post('scene_id'),
				'shot_name' => $this->input->post('shot_name'),
				'shot_description' =>  $this->input->post('shot_description'),
				'status_id' => $this->input->post('status_id'),
				'stage_id' => $this->input->post('stage_id'),
				'shot_notes' =>  $this->input->post('shot_notes'),
				'shot_duration' => $this->input->post('shot_duration')
			);
			$this->db->where('shot_id', $shot_id);
			return $this->db->update('shots', $data);
		}
		
	}
}

