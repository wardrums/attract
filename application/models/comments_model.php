<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Comments Model
*
* Manages comments
*
* @author Francesco Siddi
* @package Attract
*/

class Comments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}
	
	/** 
	 * Retrieves one or all comments available in the database (already limiting)
	 * the selection to current show only
	 * 
	 * @access	public 
	 * @param 	int $id The comment id (default: FALSE)
	 * 
	 * @return 	array An array containing all comments data
	 */
	function get_comments($id = FALSE)
	{
		if ($id === FALSE)
		{
			$this->load->model('settings_model');
			$current_show = $this->settings_model->get_settings('current_show');
					
			$this->db->select('*'); 
		    $this->db->from('comments');
			$this->db->join('shots', 'shots.shot_id = comments.shot_id', 'left');
			$this->db->join('users', 'users.id = comments.user_id', 'left');
		    $query = $this->db->get();
				
			//print_r ($query->result_array());

			return $query->result_array();
		}
		
		else 
		{
			$this->db->select('*');
			$this->db->where('comment_id', $id); 
		    $this->db->from('comments');
		    $query = $this->db->get();
			
			return $query->row_array();
		}
	}
	
	
	/** 
	 * Retrieves one or all comments for a specific shot
	 * 
	 * @access	public 
	 * @param 	int $id The shot id
	 * 
	 * @return 	array An array containing all comments data
	 */
	function get_shot_comments($shot_id)
	{
		$this->load->library('gravatar');
		$this->load->model('settings_model');
		$this->load->model('attachments_model');
		
		$current_show = $this->settings_model->get_settings('current_show');
				
		$this->db->select('comments.*, users.*, attachments.attachment_path, attachments.attachment_name'); 
		//$this->db->select('GROUP_CONCAT(DISTINCT shots_users.user_id SEPARATOR ",") as user_id', FALSE); 
	    $this->db->from('comments');
		$this->db->join('users', 'users.id = comments.user_id', 'left');
		$this->db->join('comments_attachments', 'comments_attachments.comment_id = comments.comment_id', 'left');
		$this->db->join('attachments', 'attachments.attachment_id = comments_attachments.attachment_id', 'left');
		//$this->db->group_by('comments.comment_id'); 
		$this->db->where('shot_id', $shot_id); 
	    $query = $this->db->get();
		$comments = $query->result_array();	
		//print_r ($query->result_array());
		foreach ($comments as $comment => $value) 
		{
			//$comments[$comment]['email'] = $this->gravatar->get_gravatar($comment['email'], NULL, 60);
			$comments[$comment]['gravatar'] = $this->gravatar->get_gravatar($value['email'], NULL, 60);
			
		}
		return $comments;
	
	}
		
	
	function create_comment()
	{
		// we user the auth library to get the current user ID and associate it with the comment
		$user = $this->ion_auth->user()->row();
		
		// for both comment_edit_date and comment_creation_date we have NULL (the dabase will handle this)
		$data = array(
			'shot_id' => $this->input->post('shot_id'),
			'user_id' => $user->id,
			'comment_body' => $this->input->post('comment_body'),
			'comment_edit_date' => NULL,
			'comment_creation_date' => NULL
		);

		$this->db->insert('comments', $data);
		return $this->db->insert_id();
	}

	function edit_comment()
	{
		$comment_id = $this->input->post('comment_id');
		
		$data = array(
			'comment_name' => $this->input->post('comment_name'),
			'comment_description' => $this->input->post('comment_description'),
		);
		
		$this->db->where('comment_id', $comment_id);
		$this->db->update('comments', $data);
		return;
	}
	
	/** 
	 * Deletes a specific comment based on id
	 * 
	 * @access	public 
	 * @param 	int $comment_id The comment id
	 * 
	 * @return 	TRUE is successful
	 */
	function delete_comment($comment_id)
	{			
		$this->db->select('*'); 
		$this->db->where('comments_attachments.comment_id', $comment_id);
	    $this->db->from('comments_attachments');

	    $query = $this->db->get();	
		$comments_attachments = $query->result_array();
		
		// we check if any attachment is connected to that comment. If we find something
		// we loop thgough it until all attachments have been deleted
		if(isset($comments_attachments))
		{
			foreach ($comments_attachments as $comment_attachment) 
			{
				// we get the attachment_name in order to build the filepath to be removed
				// from the system
				$this->db->select('attachments.attachment_path'); 
				$this->db->where('attachment_id', $comment_attachment['attachment_id']);
	    		$this->db->from('attachments');
				$query = $this->db->get();
				$attachment = $query->row_array();
				
				$file_path = realpath(APPPATH . '../uploads/' . $attachment['attachment_path']);
				unlink($file_path);
				
				// we delete the row in the attachments table
		 		$this->db->where('attachment_id', $comment_attachment['attachment_id']);
				$this->db->delete('attachments');
		 		
				// finally we delete the relation between comment and attachment
		 		$this->db->where('attachment_id', $comment_attachment['attachment_id']);
				$this->db->delete('comments_attachments');
			}	
		}
		
		// we delete the actual comment
		$this->db->where('comment_id', $comment_id);
		$this->db->delete('comments');
		return /*$comment->comment_id*/;
		
	}
	
}

/* End of file comments_model.php */
/* Location: ./application/models/comments_model.php */
