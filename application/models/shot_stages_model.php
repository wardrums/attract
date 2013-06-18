<?php
class Shot_stages_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_shot_stages($id = FALSE)
	{
		if ($id === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('shot_stages');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
	}
	
	function create_shot_stage()
	{
		$data = array(
			'shot_stage_name' => $this->input->post('shot_stage_name')
		);

		$this->db->insert('shot_stages', $data);
		return;
	}

	function edit_shot_stage()
	{
		$shot_stage_id = $this->input->post('shot_stage_id');
		
		$data = array(
			'shot_stage_name' => $this->input->post('shot_stage_name'),
		);
		
		$this->db->where('shot_stage_id', $shot_stage_id);
		$this->db->update('shots', $data);
		return;
	}
}

