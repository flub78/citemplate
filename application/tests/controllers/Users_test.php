<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Users_test extends TestCase
{

	function __construct() {
		parent :: __construct();
		$this->resetInstance();
		$this->CI->load->library('ciauth');
		$this->CI->ciauth->login('testuser', 'testuser', true);
		
		// Also load the model, controller test are a little more than unit tests
		$this->CI->load->model('crud_model', 'model');
		$this->model = $this->CI->model;		
	}
	
// 	public function ttest_all() {
// 		$methods = array('create');
// 		foreach ($methods as $method) {
// 			$id = 42;
// 			$output = $this->request('GET', ['Users', $method]);
// 			$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
// 		}	
// 	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Users', 'unknow_method']);
		$this->assertResponseCode(404);
	}

	public function test_crud()
	{
		# Check create form
		$output =  $this->request('GET', ['Users', 'create']);
		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
	
		# Actually create something
		$count =  $this->model->count('ciauth_user_accounts');
	
		echo "attempt to create a user with no password";
		$args = array("email"	=> "test@free.fr",
				"username" => "test",
				"password" => "pas",
				"password-confirm" => "password"
		);
		$output =  $this->request('POST', ['users', 'validate', 'edit'], $args);
		// echo $output;
		echo "user with no password validated";

		$this->request('POST', ['users', 'add'], $args);
		$id = $this->model->get_last_inserted();
		
		echo "check that a user has been created";
		$new_count =  $this->model->count('ciauth_user_accounts');
		$this->assertEquals($count +1, $new_count, "One privilege has been created");
			
		// change it
		$args = array("privilege_description"	=> "For really super hero",
				"privilege_name" => "Superpower",
				"privilege_id" => $id,
				"submit" => "submit");
		// http://localhost/citemplate/index.php/Users/validate/create
		$output =  $this->request('POST', ['Users', 'validate', 'edit'], $args);
			
		// read it
		$output =  $this->request('GET', ['Users', 'edit', $id]);
		$this->assertNotEquals("", $output, "Edit");
		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
	
		// delete if
// 		return;
		$output =  $this->request('GET', ['Users', 'delete', $id]);
		$new_count =  $this->model->count('ciauth_user_accounts');
		$this->assertEquals($count, $new_count, "One user has been deleted");
	}
	
}
