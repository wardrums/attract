<?php
class Sequences_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}
	
	function get_sequences($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->load->model('settings_model');
			$current_show = $this->settings_model->get_settings('current_show');
					
			$this->db->select('*'); 
			$this->db->where('show_id', $current_show['setting_value']); 
		    $this->db->from('sequences');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		else 
		{
			$this->db->select('*');
			$this->db->where('sequence_id', $id); 
		    $this->db->from('sequences');
		    $query = $this->db->get();
			
			return $query->row_array();
		}
	}
	
	function create_sequence()
	{
		
		$this->load->model('settings_model');
		$current_show = $this->settings_model->get_settings('current_show');
		
		$data = array(
			'sequence_name' => $this->input->post('sequence_name'),
			'sequence_description' => $this->input->post('sequence_description'),
			'show_id' => $current_show['setting_value']
		);

		$this->db->insert('sequences', $data);
		return $this->input->post('sequence_name');
	}

	function edit_sequence()
	{
		$sequence_id = $this->input->post('sequence_id');
		
		$data = array(
			'sequence_name' => $this->input->post('sequence_name'),
			'sequence_description' => $this->input->post('sequence_description'),
		);
		
		$this->db->where('sequence_id', $sequence_id);
		$this->db->update('sequences', $data);
		return;
	}
	
	// will refactor this later into delete_sequence and delete_sequences
	function delete_sequence($sequence_id)
	{
		$this->load->model('scenes_model');
		
		$this->db->select('*'); 
		$this->db->where('sequence_id', $sequence_id);
	    $this->db->from('scenes');
	    $query = $this->db->get();	
		$scenes = $query->result_array();
		
		if(isset($scenes))
		{
			foreach ($scenes as $scene) 
			{
				$this->scenes_model->delete_scene($scene['scene_id']);
			}	
		}
		
		$this->db->where('sequence_id', $sequence_id);
		$this->db->delete('sequences');
		return;
		
	}
	

}

