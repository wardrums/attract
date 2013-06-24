<?php
class Statuses_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_statuses($id = FALSE)
	{
		if ($id === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('statuses');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
	}

}

