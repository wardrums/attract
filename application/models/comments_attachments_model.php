<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Comments Attachments Model
*
* Manages the relation between comment_attachments_attachments and attachments
*
* @author Francesco Siddi
* @package Attract
*/

class Comments_attachments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}
	
	/** 
	 * Retrieves one or all comment_attachments_attachments available in the database (already limiting)
	 * the selection to current show only
	 * 
	 * @access	public 
	 * @param 	int $id The comment_attachment id (default: FALSE)
	 * 
	 * @return 	array An array containing all comment_attachments_attachments data
	 */
	function get_comment_attachments($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->load->model('settings_model');
			$current_show = $this->settings_model->get_settings('current_show');
					
			$this->db->select('*'); 
		    $this->db->from('comment_attachments_attachments');
			$this->db->join('shots', 'shots.shot_id = comment_attachments_attachments.shot_id', 'left');
			$this->db->join('users', 'users.id = comment_attachments_attachments.user_id', 'left');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		else 
		{
			$this->db->select('*');
			$this->db->where('comment_attachment_id', $id); 
		    $this->db->from('comment_attachments_attachments');
		    $query = $this->db->get();
			
			return $query->row_array();
		}
	}
	

	function create_comment_attachment($attachment_id, $comment_id)
	{	
		// we simply create add an entry in the many to many table
		$data = array(
			'attachment_id' => $attachment_id,
			'comment_id' => $comment_id
		);

		$this->db->insert('comments_attachments', $data);
		return;
	}

	function edit_comment_attachment()
	{
		$comment_attachment_id = $this->input->post('comment_attachment_id');
		
		$data = array(
			'comment_attachment_name' => $this->input->post('comment_attachment_name'),
			'comment_attachment_description' => $this->input->post('comment_attachment_description'),
		);
		
		$this->db->where('comment_attachment_id', $comment_attachment_id);
		$this->db->update('comment_attachments_attachments', $data);
		return;
	}
	

	function delete_comment_attachment($id)
	{

		$this->db->where('comment_attachment_id', $id);
		$this->db->delete('comments_attachments');
		return $comment_attachment->shot_id;
		
	}
	
}

/* End of file comments_attachments_model.php */
/* Location: ./application/models/comments_attachments_model.php */
