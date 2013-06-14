<?php

class Shots extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('shots_model');
	}

	public function index()
	{
		$data['shots'] = $this->shots_model->get_shots();
		$data['title'] = 'Shots';
		$data['use_sidebar'] = TRUE;
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('shots/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($id)
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
	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create a new shot';
		
		$this->form_validation->set_rules('shot_name', 'text', 'required');
		$this->form_validation->set_rules('shot_description', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('shots/create');
			$this->load->view('templates/footer');
			
		}
		else
		{
			$this->shots_model->set_shots();
			$this->load->view('templates/header', $data);	
			$this->load->view('shots/create');
			$this->load->view('templates/footer');
			
		}
	}
	
	public function edit($id)
	{
		$this->load->model('scenes_model');
		$this->load->model('shot_statuses_model');
		
		$data['shot'] = $this->shots_model->get_shots($id);
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['statuses'] = $this->shot_statuses_model->get_shot_statuses();
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
			$this->shots_model->set_shots($id);
			$data['shot'] = $this->shots_model->get_shots($id);
			$this->load->view('templates/header', $data);	
			$this->load->view('shots/edit', $data);
			$this->load->view('templates/footer');
		}
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
