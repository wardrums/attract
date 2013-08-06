<?php
class Scenes_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_scenes($id = FALSE)
	{
		if ($id === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('scenes');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
	}
	
	function create_scene()
	{
		$data = array(
			'scene_name' => $this->input->post('scene_name'),
			'scene_description' => $this->input->post('scene_description'),
			'sequence_id' => 1
		);

		$this->db->insert('scenes', $data);
		return $this->input->post('scene_name');
	}
	
	function edit_scene()
	{
		$scene_id = $this->input->post('scene_id');
		
		$data = array(
			'scene_name' => $this->input->post('scene_name'),
			'scene_description' => $this->input->post('scene_description')
		);
		
		$this->db->where('scene_id', $scene_id);
		$this->db->update('scenes', $data);
		return;
	}

}

