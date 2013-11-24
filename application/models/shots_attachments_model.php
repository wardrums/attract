<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Shots Attachments Model
*
* Manages the relation between shots and attachments
*
* @author Francesco Siddi
* @package Attract
*/

class Shots_attachments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}
	
	/** 
	 * Retrieves one or all shot_attachments available in the database (already limiting)
	 * the selection to current shot only
	 * 
	 * @access	public 
	 * @param 	int $shot_id The shot_id (default: FALSE)
	 * 
	 * @return 	array An array containing all shot_attachments data
	 */
	function get_shot_attachments($shot_id = FALSE)
	{
		if ($shot_id === FALSE)
		{
			// XXX This code is broken and unused
			
			$this->load->model('settings_model');
			$current_show = $this->settings_model->get_settings('current_show');
					
			$this->db->select('*'); 
		    $this->db->from('shot_attachments_attachments');
			$this->db->join('shots', 'shots.shot_id = shots_attachments_attachments.shot_id', 'left');
			$this->db->join('users', 'users.id = shots_attachments_attachments.user_id', 'left');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		else 
		{
			$this->db->select('*');
			$this->db->where('shot_id', $shot_id); 
			$this->db->join('attachments', 'attachments.attachment_id = shots_attachments.attachment_id', 'left');
			$this->db->order_by('id', 'desc'); 
		    $this->db->from('shots_attachments');
		    $query = $this->db->get();
			
			return $query->result_array();
		}
	}
	

	function create_shot_attachment($attachment_id, $shot_id)
	{
		// we make all shot attachments not current
		$data = array(
			'is_current' => 0,
		);
		
		$this->db->where('shot_id', $shot_id);
		$this->db->update('shots_attachments', $data);
			
		// we simply create add an entry in the many to many table
		$data = array(
			'attachment_id' => $attachment_id,
			'shot_id' => $shot_id,
			'is_current' => 1
		);

		$this->db->insert('shots_attachments', $data);
		return;
	}

	function edit_shot_attachment()
	{
		$shot_attachment_id = $this->input->post('shot_attachment_id');
		
		$data = array(
			'shot_attachment_name' => $this->input->post('shot_attachment_name'),
			'shot_attachment_description' => $this->input->post('shot_attachment_description'),
		);
		
		$this->db->where('shot_attachment_id', $shot_attachment_id);
		$this->db->update('shot_attachments_attachments', $data);
		return;
	}
	

	function delete_shot_attachment($id)
	{

		$this->db->where('id', $id);
		$this->db->delete('shots_attachments');
		return;

	}
	
}

/* End of file shots_attachments_model.php */
/* Location: ./application/models/shots_attachments_model.php */
