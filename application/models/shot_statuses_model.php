<?php
class Shot_statuses_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_shot_statuses($id = FALSE)
	{
		if ($id === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('shot_statuses');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
	}

}

