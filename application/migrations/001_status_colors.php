<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Status_colors extends CI_Migration {

	public function up()
	{
		$fields = array(
			'status_color' => array(
				'type' => 'TEXT',
				'constraint' => '10',
				'null' => TRUE
			)
		);
		$this->dbforge->add_column('statuses', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('statuses', 'status_color');
	}
}

/* End of file 001_status_colors.php */
/* Location: ./application/migrations/001_status_colors.php */
