<?php

class Shows extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shows_model');
	}

	function index($format = FALSE)
	{
		$this->load->model('settings_model');
		if (!$format)
		{
			// we get the current show setting (in the view we will get the ID and check it)
			$data['current_show'] = $this->settings_model->get_settings('current_show');
			$data['shows'] = $this->shows_model->get_shows();
			$data['title'] = 'Shows';
			$data['use_sidebar'] = TRUE;
			
		
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('shows/index', $data);
			$this->load->view('templates/footer');
		} 
		else if ($format == 'JSON')
		{
			$data['shows'] = $this->shows_model->get_shows();
			$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($data));
		}
		
	}
		
	
	function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create show';
		$data['use_sidebar'] = TRUE;
		
		$this->form_validation->set_rules('show_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('shows/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			// we create the show and get its name to expose it the next flash
			$show_name = $this->shows_model->create_show();

			$this->session->set_flashdata('message', 'Show <strong>' . $show_name . '</strong> added to database!');

			redirect('/shows/create');
			
		}
	}
	
	function edit($show_id)
	{
		
		$data['show'] = $this->shows_model->get_shows($show_id);	
		$data['title'] = 'Edit Show';
		$data['use_sidebar'] = TRUE;
		
		if (empty($data['show']))
		{
			show_404();
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('show_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
		
			$this->load->view('templates/header', $data);	
			$this->load->view('templates/sidebar', $data);
			$this->load->view('shows/edit', $data);
			$this->load->view('templates/footer');	
		}
		else
		{
						
			// first we create the new tasks, which should be assigned to a user right after the page is reloaded
			$this->shows_model->edit_show();
			
			redirect('/shows/edit/' . $show_id, 'refresh');
		}
	}

}


