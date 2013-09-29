<?php

class Settings extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('settings_model');
	}

	function index()
	{
		
		$data['settings'] = $this->settings_model->get_settings();
		$data['title'] = 'Settings';
		$data['use_sidebar'] = TRUE;
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('settings/index', $data);
		$this->load->view('templates/footer');
	}
	
	function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create setting';
		$data['use_sidebar'] = TRUE;
		
		$this->form_validation->set_rules('setting_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('settings/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			// we create the setting and get its name to expose it the next flash
			$setting_name = $this->settings_model->create_setting();

			$this->session->set_flashdata('message', 'Setting <strong>' . $setting_name . '</strong> added to database!');

			redirect('/settings/create');
			
		}
	}
	
	function edit($setting_name, $async = FALSE)
	{
		
		$data['setting'] = $this->settings_model->get_settings($setting_name);	
		$data['title'] = 'Edit Setting';
		$data['use_sidebar'] = TRUE;
		
		if (empty($data['setting']))
		{
			show_404();
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('setting_name', 'text', 'required');
		
		
		if ($this->form_validation->run() === FALSE)
		{
			if ($async)
			{
				$this->load->view('settings/edit_ajax', $data);
			}
			else 
			{
				$this->load->view('templates/header', $data);	
				$this->load->view('templates/sidebar', $data);
				$this->load->view('settings/edit', $data);
				$this->load->view('templates/footer');	
			}
		}
		else
		{
						
			// first we create the new tasks, which should be assigned to a user right after the page is reloaded
			$this->settings_model->edit_setting();
			
			$this->output
		    	->set_content_type('application/json')
		    	->set_output(json_encode(array('status' => 'done')));
		}
	}

}


