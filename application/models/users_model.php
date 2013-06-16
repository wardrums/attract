<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_users($id = FALSE)
	{
		if ($id === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('users');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
	}

}

