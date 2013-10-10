<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Comments extends CI_Migration {

	public function up()
	{
		
		
		$fields = array(
            'comment_id' => array(
                 'type' => 'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
                              ),
            'shot_id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => TRUE
                              ),
            'user_id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => TRUE
                              ),
            'comment_body' => array(
                 'type' => 'TEXT',
                 'null' => TRUE
                              ),
            'comment_edit_date' => array(
                 'type' => 'TIMESTAMP'
           						),
           	'comment_creation_date' => array(
	             'type' => 'TIMESTAMP'
                              ),
        );
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('comment_id', TRUE);
		
		$this->dbforge->create_table('comments');
		// gives CREATE TABLE table_name
	}

	public function down()
	{
		$this->dbforge->drop_table('comments');
	}
}

/* End of file 002_comments.php */
/* Location: ./application/migrations/002_comments.php */
