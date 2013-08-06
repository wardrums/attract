<?php

class Tasks extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tasks_model');
	}

	function index()
	{
		$this->load->model('tasks_model');
		$data['tasks'] = $this->tasks_model->get_tasks();
		$data['title'] = 'Tasks';
		$data['use_sidebar'] = TRUE;
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tasks/index', $data);
		$this->load->view('templates/footer');
	}
	
	function create()
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
			$this->load->view('tasks/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			$task_name = $this->tasks_model->create_task();

			$this->session->set_flashdata('message', 'Task <strong>'. $task_name .'</strong> added to database!');

			redirect('/tasks/create');
			
		}
	}

}


