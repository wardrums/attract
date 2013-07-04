<?php
class Scenes_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_scenes($id = FALSE)
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

}

