<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Comments Controller
*
* Manages comments
*
* @author Francesco Siddi
* @package Attract
*/


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
		
		$this->form_validation->set_rules('shot_id', 'comment_body');
		
				
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('comments/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			$shot_id = $this->input->post('shot_id');
			
			$this->load->model('attachments_model');
		
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '2048';
			$config['max_height']  = '2048';
			$config['encrypt_name'] = true;

			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload())
			{
				// we skip the missing file!	
				$data['error'] = $this->upload->display_errors();
				echo $data['error'];
				//redirect('shots/view/' . $shot_id);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$this->attachments_model->create_attachment($data['upload_data']['orig_name'], $data['upload_data']['raw_name'] . $data['upload_data']['file_ext']);
				$this->load->view('upload_success', $data);	
			}
			// we create the comment and get its name to expose it the next flash
			$comment = $this->comments_model->create_comment();

			//$this->session->set_flashdata('message', 'Comment <strong>' . $shot_id . '</strong> added to database!');

			redirect('/shots/view/' . $comment);
			
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
		//$this->load->model('comments_attachments_model');
		
		$data['comment'] = $this->comments_model->get_comments($comment_id);
				
		if (empty($data['comment']))
		{
			show_404();
		}
		
		// the following call deletes the comment and the associated attachments		
		$shot_id = $this->comments_model->delete_comment($comment_id);
		
		//$this->comments_attachments_model->delete_comment_attachment($comment_id);
		
		$this->session->set_flashdata('message', 'Comment <strong>' . $comment_id . '</strong> has been deleted, along with the relative data!');
		redirect('/shots/view/' . $data['comment']['shot_id']);
	}

}

/* End of file comments.php */
/* Location: ./application/controllers/comments.php */

