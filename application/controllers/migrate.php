<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends Admin_Controller {
	public function index()
	{
		$this->load->library('migration');
		
		$migration_version = $this->migration->current();

		if ( ! $migration_version)
		{
			show_error($this->migration->error_string());
		} 
		else 
		{

			$this->session->set_flashdata('message', 'Attract databse upgraded to version <strong>' . $migration_version . '</strong>');
			redirect('/shots/index');
		}
	}
}

/* End of file migrate.php */
/* Location: ./application/controllers/migrate.php */
