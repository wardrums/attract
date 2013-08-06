<?php

class Statuses extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('statuses_model');
	}

	function index()
	{
		$this->load->model('statuses_model');
		$data['statuses'] = $this->statuses_model->get_statuses();
		$data['title'] = 'Statuses';
		$data['use_sidebar'] = TRUE;
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('statuses/index', $data);
		$this->load->view('templates/footer');
	}
	
	function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->load->model('statuses_model');
		$data['title'] = 'Create status';
		$data['use_sidebar'] = TRUE;
		
		$this->form_validation->set_rules('status_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('statuses/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			// we create the status and get its name to expose it the next flash
			$status_name = $this->statuses_model->create_status();

			$this->session->set_flashdata('message', 'Status <strong>' . $status_name . '</strong> added to database!');

			redirect('/statuses/create');
			
		}
	}

}


