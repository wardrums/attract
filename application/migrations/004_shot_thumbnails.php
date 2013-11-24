<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Shot_thumbnails extends CI_Migration {

	public function up()
	{
			
		// shots_attachments table generation
		$fields = array(
			'id' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
            				),
            'attachment_id' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE,
                              ),
            'shot_id' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE
             				),
             'is_current' => array(
                 'type' => 'BOOL' 
             				)
        );
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		
		$this->dbforge->create_table('shots_attachments');

	}

	public function down()
	{
		$this->dbforge->drop_table('shots_attachments');
	}
}

/* End of file 004_shot_thumbnails.php */
/* Location: ./application/migrations/004_shot_thumbnails.php */
