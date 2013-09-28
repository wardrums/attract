<?php
class Settings_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_settings($setting_name = FALSE)
	{
		if ($setting_name === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('settings');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		else 
		{
			$this->db->select('*');
			$this->db->where('setting_name', $setting_name); 
		    $this->db->from('settings');
		    $query = $this->db->get();
			
			return $query->row_array();
		}
	}
	
	
	function create_setting()
	{
		$data = array(
			'setting_name' => $this->input->post('setting_name'),
			'setting_value' => $this->input->post('setting_value'),
		);

		$this->db->insert('settings', $data);
		return $this->input->post('setting_name');
	}

	function edit_setting()
	{
		$setting_id = $this->input->post('setting_id');
		
		$data = array(
			'setting_name' => $this->input->post('setting_name'),
			'setting_value' => $this->input->post('setting_value'),
		);
		
		$this->db->where('setting_id', $setting_id);
		$this->db->update('settings', $data);
		return;
	}
	

}

