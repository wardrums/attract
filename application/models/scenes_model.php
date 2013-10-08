<?php
class Scenes_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_scenes($id = FALSE)
	{
		// we set up a filter in order to get only get scenes from the current show
		$this->load->model('settings_model');
		$current_show = $this->settings_model->get_settings('current_show');
		
		if ($id === FALSE)
		{
			$this->db->select('*'); 
			$this->db->join('sequences', 'sequences.sequence_id = scenes.sequence_id', 'left');
			$this->db->where('show_id', $current_show['setting_value']);
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
			'sequence_id' => $this->input->post('sequence_id')
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

	function delete_scene($scene_id)
	{
		$this->load->model('shots_model');
		
		$this->db->select('*'); 
		$this->db->where('scene_id', $scene_id);
	    $this->db->from('shots');
	    $query = $this->db->get();	
		$shots = $query->result_array();
		
		if (isset($shots))
		{
			foreach ($shots as $shot) 
			{
				$this->shots_model->delete_shot($shot['shot_id']);
			}
		}
			
		$this->db->where('scene_id', $scene_id);
		$this->db->delete('scenes');
		return;
	}

}

