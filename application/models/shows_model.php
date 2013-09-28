<?php
class Shows_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_shows($id = FALSE)
	{
		if ($id === FALSE)
		{
					
			$this->db->select('*'); 
		    $this->db->from('shows');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		else 
		{
			$this->db->select('*');
			$this->db->where('show_id', $id); 
		    $this->db->from('shows');
		    $query = $this->db->get();
			
			return $query->row_array();
		}
	}
	
	function create_show()
	{
		$data = array(
			'show_name' => $this->input->post('show_name'),
			'show_description' => $this->input->post('show_description'),
			'show_path' => $this->input->post('show_path')
		);

		$this->db->insert('shows', $data);
		return $this->input->post('show_name');
	}

	function edit_show()
	{
		$show_id = $this->input->post('show_id');
		
		$data = array(
			'show_name' => $this->input->post('show_name'),
			'show_description' => $this->input->post('show_description'),
			'show_path' => $this->input->post('show_path')
		);
		
		$this->db->where('show_id', $show_id);
		$this->db->update('shows', $data);
		return;
	}
	

}

