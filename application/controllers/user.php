<?php

class User extends User_Controller {

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

	function tasks()
	{
		$this->load->model('tasks_model');
		$this->load->model('shot_tasks_users_model');
		
		$user = $this->ion_auth->user()->row();

		$data['shots'] = $this->shot_tasks_users_model->get_shots($user->id);
		$data['title'] = 'Tasks';
		$data['use_sidebar'] = TRUE;
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('user/tasks', $data);
		$this->load->view('templates/footer');
	}
	
}
