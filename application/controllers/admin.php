<?php

class Admin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('users_model');
		//$this->load->model('ion_auth_model');
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
		$data['users'] = $this->users_model->get_users();
		$data['title'] = 'Users';
		$data['use_sidebar'] = TRUE;
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/users', $data);
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
		$this->load->model('shot_stages_model');
		$this->load->model('shots_users_model');
		
		$data['title'] = 'Create a new shot';
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['statuses'] = $this->shot_statuses_model->get_shot_statuses();
		$data['stages'] = $this->shot_stages_model->get_shot_stages();
		$last_shot_position = $this->shots_model->get_last_shot_position();
		$data['shot_order'] = $last_shot_position['shot_order'] + 1;
		
		$this->form_validation->set_rules('shot_name', 'text', 'required');
		$this->form_validation->set_rules('shot_description', 'text', 'required');
		
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
		$this->load->model('shot_statuses_model');
		$this->load->model('shot_stages_model');
		$this->load->model('shots_users_model');
		$this->load->model('users_model');
		
		$data['shot'] = $this->shots_model->get_shots($shot_id);
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['statuses'] = $this->shot_statuses_model->get_shot_statuses();
		$data['stages'] = $this->shot_stages_model->get_shot_stages();
		$data['users'] = $this->users_model->get_users();
		$data['shot_users'] = $this->shots_users_model->get_users($shot_id);
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
			$this->shots_users_model->set_users($shot_id);
			redirect('/shots/', 'refresh');
			/*
			// we reset the data array before reloading the page
			$data['shot'] = $this->shots_model->get_shots($shot_id);
			$data['shot_users'] = $this->shots_users_model->get_users($shot_id);
			$this->load->view('templates/header', $data);	
			$this->load->view('shots/edit', $data);
			$this->load->view('templates/footer');
			*/
		}
	}

	function delete($shot_id)
	{
		$this->shots_model->delete_shot($shot_id);
		redirect('/shots/', 'refresh');
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
