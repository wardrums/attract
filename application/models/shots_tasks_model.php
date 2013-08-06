<?php
class Shots_tasks_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_tasks($shot_id = FALSE)
	{
					
		$this->db->select('shots_tasks.shot_task_id, shots_tasks.task_id, tasks.task_name, shots_tasks.status_id, statuses.status_name'); 
	    $this->db->from('shots_tasks');
		$this->db->join('tasks', 'tasks.task_id = shots_tasks.task_id', 'left');
		$this->db->join('statuses', 'statuses.status_id = shots_tasks.status_id', 'left');
		if ($shot_id)
		{
			$this->db->where('shots_tasks.shot_id', $shot_id); 
		}
	    $query = $this->db->get();
			
		//print_r ($query->result_array());

		return $query->result_array();
	}
	
	function set_task($shot_id, $task_id, $status_id)
	{	
		$data_check = array(
			'task_id' => $task_id,
			'shot_id' => $shot_id
		);
		
		$data = array(
			'task_id' => $task_id,
			'shot_id' => $shot_id,
			'status_id' => $status_id
		);
		
		$shot_exists = $this->db->get_where('shots_tasks', $data_check);
		$shot_exists = $shot_exists->row();
		
		if (empty($shot_exists)) {
			$this->db->insert('shots_tasks', $data);
			return $this->db->insert_id();
		}
		else 
		{
			$this->db->where('shot_task_id', $shot_exists->shot_task_id);
			return $this->db->update('shots_tasks', $data);
		}
		
	}
	
	function remove_tasks($shot_id, $task_id = FALSE)
	{
		$data = array(
			'shot_id' => $shot_id
		);
		
		// we add the task_id if we want to remove a specific task, otherwise all the tasks
		// associated with that shot will be removed
		if ($task_id)
		{
			$data['task_id'] = $task_id;
		}
		
		$shot_exists = $this->db->get_where('shots_tasks', $data);
		$shot_exists->row();
		
		if ($shot_exists) {
			return $this->db->delete('shots_tasks', $data);
		}
		else 
		{
			show_error();
		}
	}
	
	function set_tasks($shot_id)
	{
		$new_tasks = $this->input->post('tasks');
		
		if (!$new_tasks) {
			$new_tasks = array();
		}
		
		$new_tasks_id = array_keys($new_tasks);	
			
		if ($new_tasks_id == '')
		{
			$new_tasks_id = array();
		}	
		
		
		$this->db->select('shots_tasks.task_id'); 
	    $this->db->from('shots_tasks');
		$this->db->where('shot_id', $shot_id);
		$query = $this->db->get();
		
		$old_tasks_id = $query->result_array();
		$old_tasks_id_clean = array();
		
		// we make a list of the old user ids (by pusing them in a temp array)
		foreach ($old_tasks_id as $entry)
		{
			array_push($old_tasks_id_clean, $entry['task_id']);			
		}

		$old_tasks_id = $old_tasks_id_clean;

		// we check which tasks id are actually new by comparing them with the current one
		//$new_tasks_id_diff = array_diff($new_tasks_id, $old_tasks_id);
		$new_tasks_id_diff = $new_tasks_id;
		
		// we assign those new tasks to the list
		foreach ($new_tasks_id_diff as $task_id) 
		{	
			$this->set_task($shot_id, $task_id, $new_tasks[$task_id]['status_id']);
		}

		$removed_tasks_id = array();
		
		foreach ($old_tasks_id as $task_id) 
		{
			if (!in_array($task_id, $new_tasks_id)) {
				array_push($removed_tasks_id, $task_id);
			}
		}
		
		foreach ($removed_tasks_id as $task_id) 
		{
			$this->remove_tasks($shot_id, $task_id);
		}
		
		return;
		
	}
	
	// we query the database for a specific task_id and status_id, then we join
	// the shots table and return the matching shots
	
	function get_shots_by_tasks($task_id, $status_id) {
		$this->db->select('shots_tasks.shot_task_id, shots.shot_id, shots.shot_name, shots.shot_description, shots.shot_duration, shots.shot_notes'); 
	    $this->db->from('shots_tasks');
		$this->db->join('shots', 'shots.shot_id = shots_tasks.shot_id', 'left');
		$this->db->where('shots_tasks.task_id', $task_id); 
		$this->db->where('shots_tasks.status_id', $status_id); 
	    $query = $this->db->get();
			
		//print_r ($query->result_array());

		return $query->result_array();
	}

}

