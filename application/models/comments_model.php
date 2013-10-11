<?php
class Comments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}
	
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
	
	function get_shot_comments($shot_id)
	{
		$this->load->library('gravatar');
		$this->load->model('settings_model');
		$current_show = $this->settings_model->get_settings('current_show');
				
		$this->db->select('*'); 
	    $this->db->from('comments');
		$this->db->join('users', 'users.id = comments.user_id', 'left');
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
		return $data['shot_id'];
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
	
	// will refactor this later into delete_comment and delete_comments
	function delete_comment($comment_id)
	{
		// The following code can be used for attachments
		
		$this->db->select('*'); 
		$this->db->where('comment_id', $comment_id);
	    $this->db->from('comments');
	    $query = $this->db->get();	
		
		$comment = $query->row();
		
		/*
		$this->load->model('scenes_model');
		
		$this->db->select('*'); 
		$this->db->where('comment_id', $comment_id);
	    $this->db->from('comments');
	    $query = $this->db->get();	
		$scenes = $query->result_array();
		
		if(isset($scenes))
		{
			foreach ($scenes as $scene) 
			{
				$this->scenes_model->delete_scene($scene['scene_id']);
			}	
		}
		*/
		$this->db->where('comment_id', $comment_id);
		$this->db->delete('comments');
		return $comment->shot_id;
		
	}
	

}

