<?php
class Files_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_files($file_id = FALSE)
	{
		if ($file_id === FALSE)
		{
			$this->db->select('shots.shot_id, shots.shot_name, files.file_id, files.file_path, files.file_settings'); 
		    $this->db->from('files');
		   	$this->db->join('shots_files', 'shots_files.file_id = files.file_id', 'left');
			$this->db->join('shots', 'shots.shot_id = shots_files.shot_id', 'left');

		    $query = $this->db->get(); 
			//print_r ($query->result_array());
			return $query->result_array();
		}
	}
	
	function set_file($file_id)
	{
		
		$data = $this->input->post('properties');
				
		$this->db->where('file_id', $file_id);
		return $this->db->update('files', $data);
	}

}

