<?php

class Files extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('files_model');
	}

	function index()
	{
		$data['files'] = $this->files_model->get_files();
		$data['title'] = 'Files';
		$data['use_sidebar'] = TRUE;
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('files/index', $data);
		$this->load->view('templates/footer');
	}
	
	function edit($shot_id)
	{
		$this->files_model->set_file($shot_id);
		return redirect('/files/', 'refresh');
	}

}


