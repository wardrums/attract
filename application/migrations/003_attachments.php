<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Attachments extends CI_Migration {

	public function up()
	{
		
		// attachments table generation
		$fields = array(
            'attachment_id' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
                              ),
            'attachment_name' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 256
				 ),
            'attachment_path' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 512
                              ),
            'attachment_date' => array(
                 'type' => 'TIMESTAMP'
           						)
        );
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('attachment_id', TRUE);
		
		$this->dbforge->create_table('attachments');
		
		// attachments_comments table generation
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
            'comment_id' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE
             				),
        );
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		
		$this->dbforge->create_table('comments_attachments');

	}

	public function down()
	{
		$this->dbforge->drop_table('attachments');
		$this->dbforge->drop_table('comments_attachments');
	}
}

/* End of file 003_attachments.php */
/* Location: ./application/migrations/003_attachments.php */
