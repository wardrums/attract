<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Attachments Model
*
* Manages attachments
*
* @author Francesco Siddi
* @package Attract
* @copyright Francesco Siddi
*/

class Attachments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}
	
	function get_attachments($id = FALSE)
	{
		if ($id === FALSE)
		{
			
			$this->db->select('*'); 
		    $this->db->from('attachments');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		else 
		{
			$this->db->select('*');
			$this->db->where('attachment_id', $id); 
		    $this->db->from('attachments');
		    $query = $this->db->get();
			
			return $query->row_array();
		}
	}
	
	function create_attachment($attachment_name, $attachment_path)
	{
		
		
		$data = array(
			'attachment_name' => $attachment_name,
			'attachment_path' => $attachment_path,
			'attachment_date' => NULL
		);
		
		$this->db->insert('attachments', $data);
		$insert_id = $this->db->insert_id();
				
		return $this->db->insert_id();
	}

	function edit_attachment()
	{
		$attachment_id = $this->input->post('attachment_id');
		
		$data = array(
			'attachment_name' => $this->input->post('attachment_name'),
		);
		
		$this->db->where('attachment_id', $attachment_id);
		$this->db->update('attachments', $data);
		return;
	}
	
	// will refactor this later into delete_attachment and delete_attachments
	function delete_attachment($attachment_id)
	{
		
		$this->db->where('attachment_id', $attachment_id);
		$this->db->delete('attachments');
		return;
		
	}
	
}

/* End of file attachments_model.php */
/* Location: ./application/models/attachments_model.php */
