<?php
class Tasks_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_tasks($id = FALSE)
	{
		if ($id === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('tasks');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		} 
		else 
		{
			$this->db->select('*');
			$this->db->where('task_id', $id); 
		    $this->db->from('tasks');
		    $query = $this->db->get();
			
			return $query->row_array();
		}
	}
	
	function create_task()
	{
		$data = array(
			'task_name' => $this->input->post('task_name')
		);

		$this->db->insert('tasks', $data);
		return $this->input->post('task_name');
	}

	function edit_task()
	{
		$task_id = $this->input->post('task_id');
		
		$data = array(
			'task_name' => $this->input->post('task_name'),
		);
		
		$this->db->where('task_id', $task_id);
		$this->db->update('tasks', $data);
		return;
	}
	
	function delete_task($task_id)
	{
		$this->load->model('shots_tasks_model');
		
		$this->db->select('*'); 
		$this->db->where('task_id', $task_id);
	    $this->db->from('shots_tasks');
	    $query = $this->db->get();	
		$shot_tasks = $query->result_array();
		
		if(isset($shot_tasks))
		{
			foreach ($shot_tasks as $shot_task) 
			{
				$this->shots_tasks_model->delete_shot_task($shot_task['shot_task_id']);
			}	
		}
		
		$this->db->where('task_id', $task_id);
		$this->db->delete('tasks');
		return;
		
	}
}

