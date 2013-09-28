<?php

class Scenes extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('scenes_model');
	}

	function index()
	{
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['title'] = 'Scenes';
		$data['use_sidebar'] = TRUE;
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('scenes/index', $data);
		$this->load->view('templates/footer');
	}
	
	function create()
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->load->model('sequences_model');
		
		$data['sequences'] = $this->sequences_model->get_sequences();
		$data['title'] = 'Create scene';
		$data['use_sidebar'] = TRUE;
		
		$this->form_validation->set_rules('scene_name', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('scenes/create', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			$scene_name = $this->scenes_model->create_scene();
			
			$this->session->set_flashdata('message', 'Scene <strong>' . $scene_name . '</strong> added to database!');

			redirect('/scenes/create');
			
		}
	}

}


