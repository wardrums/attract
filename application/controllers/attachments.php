<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Attachments controller
*
* Manages the attachments uploaded to comments, shots, scenes and sequences
*
* @author Francesco Siddi
* @package Attract
*/

class Attachments extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('attachments_model');
	}

	function index()
	{
		$data['attachments'] = $this->attachments_model->get_attachments();
		$data['title'] = 'Attachments';
		$data['use_sidebar'] = TRUE;
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('attachments/index', $data);
		$this->load->view('templates/footer');
	}
	
	function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create attachment';
		$data['use_sidebar'] = TRUE;
		
		$this->form_validation->set_rules('attachment_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('attachments/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			// we create the attachment and get its name to expose it the next flash
			$attachment_name = $this->attachments_model->create_attachment();

			$this->session->set_flashdata('message', 'Attachment <strong>' . $attachment_name . '</strong> added to database!');

			redirect('/attachments/');
			
		}
	}
	
	function edit($attachment_id, $async = FALSE)
	{
		
		$data['attachment'] = $this->attachments_model->get_attachments($attachment_id);	
		$data['title'] = 'Edit Attachment';
		$data['use_sidebar'] = TRUE;
		
		if (empty($data['attachment']))
		{
			show_404();
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('attachment_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			if ($async)
			{
				$this->load->view('attachments/edit_ajax', $data);
			}
			else 
			{
				$this->load->view('attachments/edit_modal', $data);
			}
		}
		else
		{
						
			// first we create the new tasks, which should be assigned to a user right after the page is reloaded
			$this->attachments_model->edit_attachment();
			
			$this->session->set_flashdata('message', 'Attachment <strong>' . $attachment_id . '</strong> has been updated!');
			redirect('/attachments/');
		}
	}


	function delete($attachment_id, $async = FALSE)
	{
		
		$data['attachment'] = $this->attachments_model->get_attachments($attachment_id);
				
		if (empty($data['attachment']))
		{
			show_404();
		}
						
		$this->attachments_model->delete_attachment($attachment_id);
		
		$this->session->set_flashdata('message', 'Attachment <strong>' . $attachment_id . '</strong> has been deleted, along with the relative data!');
		redirect('/attachments/');
	}

}

/* End of file attachments.php */
/* Location: ./application/controllers/attachments.php */

