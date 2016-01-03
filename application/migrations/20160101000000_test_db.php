<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_test_db extends CI_Migration {

	public function up()
	{
	    $fields = array(
	       'expiration_date' => array('type' => 'TIMESTAMP',
	       'null' => true)
	    );
	    $this->dbforge->add_column('users', $fields);


	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'expiration_date');
	}
}
