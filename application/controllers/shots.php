<?php

class Shots extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shots_model');
	}

	public function index()
	{
		$data['shots'] = $this->shots_model->get_shots();
		$data['title'] = 'Shots';
		$data['use_sidebar'] = TRUE;
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
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
		$this->load->view('templates/sidebar');
		$this->load->view('shots/view', $data);
		$this->load->view('templates/footer');
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
