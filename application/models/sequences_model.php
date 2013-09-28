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
					
			$this->db->select('*'); 
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
		
		// we get the current show setting (in the view we will get the ID and check it)
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
	

}

