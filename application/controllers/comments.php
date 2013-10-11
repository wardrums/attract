<?php

class Comments extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('comments_model');
	}

	function index()
	{
		$data['comments'] = $this->comments_model->get_comments();
		$data['title'] = 'Comments';
		$data['use_sidebar'] = TRUE;
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('comments/index', $data);
		$this->load->view('templates/footer');
	}
	
	function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create comment';
		$data['use_sidebar'] = TRUE;
		
		$this->form_validation->set_rules('shot_id');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('comments/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			// we create the comment and get its name to expose it the next flash
			$shot_id = $this->comments_model->create_comment();

			//$this->session->set_flashdata('message', 'Comment <strong>' . $comment_name . '</strong> added to database!');

			redirect('/shots/view/' . $shot_id);
			
		}
	}
	
	function edit($comment_id, $async = FALSE)
	{
		
		$data['comment'] = $this->comments_model->get_comments($comment_id);	
		$data['title'] = 'Edit Comment';
		$data['use_sidebar'] = TRUE;
		
		if (empty($data['comment']))
		{
			show_404();
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('comment_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			if ($async)
			{
				$this->load->view('comments/edit_ajax', $data);
			}
			else 
			{
				$this->load->view('comments/edit_modal', $data);
			}
		}
		else
		{
						
			// first we create the new tasks, which should be assigned to a user right after the page is reloaded
			$this->comments_model->edit_comment();
			
			$this->session->set_flashdata('message', 'Comment <strong>' . $comment_id . '</strong> has been updated!');
			redirect('/comments/');
		}
	}


	function delete($comment_id, $async = FALSE)
	{
		
		$data['comment'] = $this->comments_model->get_comments($comment_id);
				
		if (empty($data['comment']))
		{
			show_404();
		}
						
		$shot_id = $this->comments_model->delete_comment($comment_id);
		
		//$this->session->set_flashdata('message', 'Comment <strong>' . $comment_id . '</strong> has been deleted, along with the relative data!');
		redirect('/shots/view/' . $shot_id);
	}

}


