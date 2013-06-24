<?php

class Stats extends Common_Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('shots_model');
	}
	
	

	function index()
	{
		// helper function to calculate percentage
		// at the moment we use it only here
		function percentage($val1, $val2, $precision = 2) 
		{
			if ($val1 == 0) {
				return 0;
			}
			$division = $val1 / $val2;
			$res = $division * 100;
			$res = round($res, $precision);	
			return $res;
		}
		
		// the idea for this set of functions is: we get the shot statuses from the database,
		// build and array using them as indexes for other arrays containing specific information
		
		// we get the statuses
		$this->load->model('shot_statuses_model');
		$shot_statuses = $this->shot_statuses_model->get_shot_statuses();
		
		// we get the stages
		$this->load->model('tasks_model');
		$tasks = $this->tasks_model->get_tasks();
		
		// we get the total duration of the show (to expose in UI and use for percent calculation)
		$total_show_duration = $this->shots_model->get_shots_sum_duration();
		$in_progress_show_duration = $this->shots_model->get_shots_sum_duration('in_progress');
		
		// initialize an auxiliary array to extract some indexes from $shot_statuses and $tasks
		$shot_statuses_names = array();
		$tasks_names = array();
		
		// in particular we extract the shot_status_name and build an array only with those values
		foreach ($shot_statuses as $shot_status)
		{
			array_push($shot_statuses_names, $shot_status['shot_status_name']);
		}
		
		foreach ($tasks as $shot_stage)
		{
			array_push($tasks_names, $shot_stage['shot_stage_name']);
		}
	
		
		// we assign the values of $shot_statuses_names as keys for the main array that we create.
		// this array will contaiall the info (shot count and total durations)
		$shot_statuses_container = array_fill_keys(
			$shot_statuses_names, 
			array('shots_count' => 0, 'shots_duration_frames' => 0)
		);
		
		// we do the same for tasks
		$tasks_container = array_fill_keys(
			$tasks_names, 
			array('shots_count' => 0, 'shots_duration_frames' => 0)
		);
		
		
		// only now we actually need to retrieve the shots from the database, and we get only a few
		// info, such as the duration and the status. Then we use the value of the status fo the $shot
		// array as a key for the main array, in order to place the shot count and shot duration values
		// in the right array
		$shots = $this->shots_model->get_statuses_and_stages();
		foreach ($shots as $shot)
		{
			$shot_statuses_container[$shot['shot_status_name']]['shots_count']++;
			$shot_statuses_container[$shot['shot_status_name']]['shots_duration_frames'] += $shot['shot_duration'];
			
			// here we fill the tasks array, only with shots that are in progress for the moment
			if ($shot['shot_status_name'] == 'in_progress')
			{
				$tasks_container[$shot['shot_stage_name']]['shots_count']++;
				$tasks_container[$shot['shot_stage_name']]['shots_duration_frames'] += $shot['shot_duration'];
			}
		}
		
		// we create the array to expose these values in the view
		$data['shots_statuses'] = array();
		$data['shots_stages'] = array();
		
		// we add to that array the actual percentages
		foreach ($shot_statuses_container as $shots_group => $value) {
			$data['shots_statuses'][$shots_group] = percentage($value['shots_duration_frames'], $total_show_duration );
		}
		
		foreach ($tasks_container as $shots_group => $value) {
			$data['shots_stages'][$shots_group] = percentage($value['shots_duration_frames'], $in_progress_show_duration );
		}
		
		
		$data['total_duration_frames'] = $total_show_duration;
		$data['total_duration_time'] = gmdate("i:s", ($total_show_duration/24));;
		$data['title'] = 'Stats';
		$data['use_sidebar'] = TRUE;
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('stats', $data);
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
		$this->load->model('shot_statuses_model');
		$this->load->model('tasks_model');
		$this->load->model('shots_users_model');
		$this->load->model('users_model');
		
		$data['shot'] = $this->shots_model->get_shots($shot_id);
		$data['scenes'] = $this->scenes_model->get_scenes();
		$data['statuses'] = $this->shot_statuses_model->get_shot_statuses();
		$data['stages'] = $this->tasks_model->get_tasks();
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
