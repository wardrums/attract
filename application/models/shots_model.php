<?php
class Shots_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_shots($id = FALSE)
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
			$this->db->group_by('shots.shot_id'); 
			$this->db->order_by('shots.shot_order', 'asc');
		    $query = $this->db->get(); 
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		// TODO: look into this http://stackoverflow.com/questions/13753739/mysql-query-group-concat-over-multiple-rows
		$this->db->select('*'); 
	    $this->db->from('shots');
		$this->db->join('scenes', 'scenes.scene_id = shots.scene_id', 'left');		
		$this->db->join('shot_statuses', 'shot_statuses.shot_status_id = shots.status_id', 'left');
		$this->db->join('shot_stages', 'shot_stages.shot_stage_id = shots.stage_id', 'left'); 
		$this->db->where('shots.shot_id', $id); 
		$query = $this->db->get();
		
		//print_r($query->row_array());
		return $query->row_array();
		
		
	}

	function set_shots($id = FALSE)
	{
		if ($id === FALSE) 
		{
			$data = array(
				'shot_name' => $this->input->post('shot_name'),
				'shot_description' =>  $this->input->post('shot_description'),
				'scene_id' => $this->input->post('scene_id'),
				'shot_duration' => $this->input->post('shot_duration'),
				'status_id' => $this->input->post('status_id'),
				'stage_id' => $this->input->post('stage_id'),
				'shot_order' => $this->input->post('shot_order')
			);
			
			$this->db->insert('shots', $data);
			
			$ownership_data = array(
				'shot_id' => $this->db->insert_id(),
				'user_id' => $this->input->post('user_id')
			);
			
			return $ownership_data;
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


	function get_shots_order()
	{
		$this->db->select('shots.shot_name, shots.shot_order'); 
	    $this->db->from('shots');
		$query = $this->db->get();
		
		//print_r($query->row_array());
		return $query->row_array();

	}
	
	function set_shot_order($shot_id)
	{
		$this->db->select('shots.shot_name, shots.shot_order'); 
	    $this->db->from('shots');
		$query = $this->db->get();
		
		//print_r($query->row_array());
		return $query->row_array();

	}
	
	function get_last_shot_position()
	{
		$this->db->select_max('shots.shot_order');
		$query = $this->db->get('shots');
				
		//print_r($query->row_array());
		return $query->row_array();
	}
	
	function delete_shot($shot_id)
	{
		$tables = array('shots', 'shots_users');
		$this->db->where('shot_id', $shot_id);
		$this->db->delete($tables);
		return;
	}
	
	function get_total_duration(){
		$this->db->select_sum('shot_duration');
		$query = $this->db->get('shots');
		$result = $query->row_array();
		return $result['shot_duration'];
	}
	
	function get_statsues(){
		$this->db->select('shots.shot_id, shots.shot_name, shots.shot_duration'); 
		$this->db->select('shot_statuses.shot_status_name'); 
	    $this->db->from('shots');
		$this->db->join('shot_statuses', 'shot_statuses.shot_status_id = shots.status_id', 'left');
		//$this->db->group_by('shots.shot_id'); 
		//$this->db->order_by('shots.shot_order', 'asc');
	    $query = $this->db->get(); 
		return $query->result_array();
	}

}

