<?php

class Admin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('users_model');
	}

	function index()
	{
		$data['users'] = $this->users_model->get_users();
		$data['title'] = 'Shot';
		$data['use_sidebar'] = TRUE;
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('templates/footer');
	}

	function users()
	{
		$this->load->library('ion_auth');
		$this->load->helper('language');
		$data['users'] = $this->ion_auth->users()->result();
		foreach ($data['users'] as $k => $user)
		{
			$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		//$data['users'] = $this->ion_auth_model->users();
		$data['title'] = 'Users';
		$data['use_sidebar'] = TRUE;
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('templates/footer');
	}

	function tasks()
	{
		$this->load->model('tasks_model');
		$data['tasks'] = $this->tasks_model->get_tasks();
		$data['title'] = 'Tasks';
		$data['use_sidebar'] = TRUE;
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/tasks', $data);
		$this->load->view('templates/footer');
	}
	
	function tasks_create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->load->model('tasks_model');
		$data['title'] = 'Create task';
		$data['use_sidebar'] = TRUE;
		
		$this->form_validation->set_rules('task_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('admin/tasks_create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			$this->tasks_model->create_task();

			$this->load->view('templates/header', $data);	
			$this->load->view('admin/tasks_create', $data);
			$this->load->view('templates/footer');
			
		}
	}

	function calendar()
	{
		$data['title'] = 'Calendar';
		$data['use_sidebar'] = TRUE;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);	
		$this->load->view('admin/calendar', $data);
		$this->load->view('templates/footer');
	}	
}
