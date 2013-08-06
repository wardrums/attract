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
		$this->db->update('shots', $data);
		return;
	}
}

