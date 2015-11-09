<?php

class Crud_model_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('crud_model', 'model');
        $this->model = $this->CI->model;
    }

    public function test_get_category_list()
    {
        $list = $this->model->select_all('ciauth_user_privileges');
        $count =  $this->model->count('ciauth_user_privileges');
        $this->assertEquals(true, count($list) >= $count, "Correct number of elements");
    }

    /**

..array(8) {
  'user_id' =>
  class stdClass#190 (7) {
    public $name =>
    string(7) "user_id"
    public $type =>
    string(3) "int"
    public $default =>
    NULL
    public $max_length =>
    string(2) "11"
    public $primary_key =>
    int(1)
    public $auto_increment =>
    int(1)
    public $allow_null =>
    bool(false)
  }
  'email' =>
  class stdClass#177 (7) {
    public $name =>
    string(5) "email"
    public $type =>
    string(7) "varchar"
    public $default =>
    NULL
    public $max_length =>
    string(2) "50"
    public $primary_key =>
    int(0)
    public $auto_increment =>
    int(0)
    public $allow_null =>
    bool(false)
  }
  'username' =>
  class stdClass#176 (7) {
    public $name =>
    string(8) "username"
    public $type =>
    string(7) "varchar"
    public $default =>
    NULL
    public $max_length =>
    string(2) "40"
    public $primary_key =>
    int(0)
    public $auto_increment =>
    int(0)
    public $allow_null =>
    bool(false)
  }
  'password' =>
  class stdClass#175 (7) {
    public $name =>
    string(8) "password"
    public $type =>
    string(7) "varchar"
    public $default =>
    NULL
    public $max_length =>
    string(3) "255"
    public $primary_key =>
    int(0)
    public $auto_increment =>
    int(0)
    public $allow_null =>
    bool(false)
  }
  'creation_date' =>
  class stdClass#174 (7) {
    public $name =>
    string(13) "creation_date"
    public $type =>
    string(9) "timestamp"
    public $default =>
    string(17) "CURRENT_TIMESTAMP"
    public $max_length =>
    NULL
    public $primary_key =>
    int(0)
    public $auto_increment =>
    int(0)
    public $allow_null =>
    bool(false)
  }
  'last_login' =>
  class stdClass#173 (7) {
    public $name =>
    string(10) "last_login"
    public $type =>
    string(9) "timestamp"
    public $default =>
    NULL
    public $max_length =>
    NULL
    public $primary_key =>
    int(0)
    public $auto_increment =>
    int(0)
    public $allow_null =>
    bool(true)
  }
     
     */
    public function test_get_table_MetaData() {
    	
    	$meta = $this->model->getTableMetaData('ciauth_user_privileges');
    	
    	$index = array();
    	foreach ($meta as $obj) {
    		$index[$obj->name] = $obj;
    	}
    	
    	$this->assertEquals('int', $index['privilege_id']->type, "Correct int type");
    	$this->assertEquals(11, $index['privilege_id']->max_length, "Correct int length");
    	$this->assertEquals(true, $index['privilege_id']->auto_increment, "Correct int auto_increment");
    	$this->assertEquals(false, $index['privilege_id']->allow_null, "Correct int allow_null");

    	$meta = $this->model->getTableMetaData('ciauth_user_accounts');
    	 
    	$index = array();
    	foreach ($meta as $obj) {
    		$index[$obj->name] = $obj;
    	}
    	// var_dump($index);
    	 
     	$this->assertEquals('timestamp', $index['creation_date']->type, "Correct timestamp type");
     	$this->assertEquals('CURRENT_TIMESTAMP', $index['creation_date']->default, "Correct timestamp default");
    	 
    }
}
