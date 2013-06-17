<?php

class Scenes extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('scenes_model');
	}

	public function index()
	{
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['title'] = 'Scenes';
		$data['use_sidebar'] = TRUE;
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('scenes/index', $data);
		$this->load->view('templates/footer');
	}

}


