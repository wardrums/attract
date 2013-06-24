<?php

class Shots extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('shots_model');
	}

	function index()
	{
		$this->load->model('statuses_model');
		$this->load->model('tasks_model');
		$this->load->model('users_model');
		$data['users'] = $this->users_model->get_users();
		$data['statuses'] = $this->statuses_model->get_statuses();
		$data['tasks'] = $this->tasks_model->get_tasks();
		$data['shots'] = $this->shots_model->get_shots();
		$data['title'] = 'Shots';
		$data['use_sidebar'] = TRUE;
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('shots/index', $data);
		$this->load->view('templates/footer');
	}

	function view($id)
	{
		$data['shot'] = $this->shots_model->get_shots($id);
		$data['title'] = 'Shot';
		
		if (empty($data['shot']))
		{
			show_404();
		}
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('shots/view', $data);
		$this->load->view('templates/footer');
	}
	
	function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('scenes_model');
		$this->load->model('shot_statuses_model');
		$this->load->model('tasks_model');
		$this->load->model('shots_users_model');
		
		$data['title'] = 'Create a new shot';
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['statuses'] = $this->shot_statuses_model->get_shot_statuses();
		$data['stages'] = $this->tasks_model->get_tasks();
		$last_shot_position = $this->shots_model->get_last_shot_position();
		$data['shot_order'] = $last_shot_position['shot_order'] + 1;
		
		$this->form_validation->set_rules('shot_name', 'text', 'required');
		$this->form_validation->set_rules('shot_description', 'text', 'required');
		$this->form_validation->set_rules('shot_duration', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('shots/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			$shot_data = $this->shots_model->set_shots();
			// TODO at the moment we assign to one hardcoded user, should be changed
			$this->shots_users_model->set_user($shot_data['shot_id'], $shot_data['user_id']);
			
			// we reload some data
			$last_shot_position = $this->shots_model->get_last_shot_position();
			$data['shot_order'] = $last_shot_position['shot_order'] + 1;
			
			$this->load->view('templates/header', $data);	
			$this->load->view('shots/create', $data);
			$this->load->view('templates/footer');
			
		}
	}
	
	function edit($shot_id)
	{
		$this->load->model('scenes_model');
		$this->load->model('statuses_model');
		$this->load->model('tasks_model');
		$this->load->model('shots_users_model');
		$this->load->model('shots_tasks_model');
		$this->load->model('users_model');
		$this->load->model('shot_tasks_users_model');
		
		$data['shot'] = $this->shots_model->get_shots($shot_id);
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['statuses'] = $this->statuses_model->get_statuses();
		$data['tasks'] = $this->tasks_model->get_tasks();
		$data['users'] = $this->users_model->get_users();
		$data['shot_users'] = $this->shots_users_model->get_users($shot_id);
		$data['shot_tasks'] = $this->shots_tasks_model->get_tasks($shot_id);
		$data['shot_tasks_users'] = $this->shot_tasks_users_model->get_users($shot_id);
		$data['title'] = 'Edit Shot';
		
		if (empty($data['shot']))
		{
			show_404();
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('shot_name', 'text', 'required');
		$this->form_validation->set_rules('shot_description', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('shots/edit', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			
				
			$this->shots_model->set_shots($shot_id);
			//$this->shots_users_model->set_users($shot_id);
			
			// first we create the new tasks, which should be assigned to a user right after the page is reloaded
			$this->shots_tasks_model->set_tasks($shot_id);
			
			// then we check if some tasks have been removed (and remove users associated with them)
			$this->shot_tasks_users_model->set_users($shot_id);
		
			
			redirect('/shots/edit/' . $shot_id, 'refresh');
		}
	}

	function delete($shot_id)
	{
		$this->shots_model->delete_shot($shot_id);
		redirect('/shots/', 'refresh');
	}

	function edit_single($shot_id, $property, $value)
	{
		print($shot_id + $property + $value);
		$data['shot'] = $this->shots_model->get_shots($shot_id);
		if (empty($data['shot']))
		{
			show_404();
		}
		$this->shots_model->set_shot_property($shot_id, $property, $value);
		return;
	}
	
	function get_users_selector($shot_id)
	{
		$this->load->model('users_model');
		$this->load->model('shots_users_model');
		
		$data['active_users'] = $this->shots_users_model->get_users($shot_id);
		$data['users'] = $this->users_model->get_users();
	
		$this->load->view('users_selector', $data);
		
	}
	
	function post_add_shot_task($shot_id)
	{
		$task_id = $this->input->post('task_id');
		$status_id = $this->input->post('status_id');
						
		$this->load->model('shots_tasks_model');
		$shot_task_id = $this->shots_tasks_model->set_task($shot_id, $task_id, $status_id);
		print $shot_task_id;
		return;
	}
	
	function assign_users($shot_id)
	{
		$this->load->model('users_model');
		$this->load->model('shots_users_model');
		
		$this->shots_users_model->set_users($shot_id);
	
		return;
		
	}
}

/*
class Shots extends CI_Controller {

	public function view($shot = 'home') {
	
		if ( ! file_exists('application/views/shots/'.$shot.'.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		$data['title'] = ucfirst($shot); // Capitalize the first letter
		
		$this->load->view('templates/header', $data);
		$this->load->view('shots/'.$shot, $data);
		$this->load->view('templates/footer', $data);

	}
	
}
 */
