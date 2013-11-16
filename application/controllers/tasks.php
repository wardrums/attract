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

	function edit($task_id, $async = FALSE)
	{
		$this->load->model('tasks_model');
		
		$data['task'] = $this->tasks_model->get_tasks($task_id);	
		$data['title'] = 'Edit Shot';
		$data['use_sidebar'] = TRUE;
		
		if (empty($data['task']))
		{
			show_404();
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('task_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			if ($async)
			{
				$this->load->view('tasks/edit_ajax', $data);
			}
			else 
			{
				//$this->load->view('templates/header', $data);	
				//$this->load->view('templates/sidebar', $data);
				$this->load->view('tasks/edit_modal', $data);
				//$this->load->view('templates/footer');	
			}
		}
		else
		{
						
			// first we create the new tasks, which should be assigned to a user right after the page is reloaded
			$this->tasks_model->edit_task();
			
			$this->session->set_flashdata('message', 'Task <strong>' . $task_id . '</strong> has been updated!');
			redirect('/tasks/');
		}
	}

	function delete($task_id, $async = FALSE)
	{
		
		$task = $this->tasks_model->get_tasks($task_id);
				
		if (empty($task))
		{
			show_404();
		}
						
		$this->tasks_model->delete_task($task_id);
		
		$this->session->set_flashdata('message', 'Task <strong>' . $task_id . '</strong> has been deleted, along with the relative data!');
		redirect('/tasks/');
	}


}


