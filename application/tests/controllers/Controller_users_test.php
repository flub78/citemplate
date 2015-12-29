<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Controller_users_test extends TestCase
{

	function __construct() {
		parent :: __construct();
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		// Also load the model, controller test are a little more than unit tests
		$this->CI->load->model('crud_model', 'model');
		$this->model = $this->CI->model;
	}

	public function test_method_404()
	{
		$this->request('GET', ['Users', 'unknow_method']);
		$this->assertResponseCode(404);
	}

	public function test_crud()
	{
		# Check create form
		$output =  $this->request('GET', ['Users', 'create']);
		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in User create form");

		# Actually create something
		$count =  $this->model->count('users');

// 		echo "\nattempt to create a user with no password";
		$args = array("email_value"	=> "test@free.fr",
				"username_value" => "test",
				"password" => "pas",
				"password-confirm" => "password"
		);
		$output =  $this->request('POST', ['users', 'validate', 'create'], $args);
		// echo $output;
// 		echo "\nuser with no password validated";


		$args = array("email_value"	=> "test@free.fr",
				"username_value" => "test",
				"password" => "password",
				"password-confirm" => "password"
		);
		// $this->request('POST', ['users', 'add'], $args);
		$this->request('POST', ['users', 'validate', 'create'], $args);
		$id = $this->model->get_last_inserted();

// 		echo "\ncheck that a user has been created id=$id";
		$new_count =  $this->model->count('users');
		$this->assertEquals($count +1, $new_count, "One User has been created");

		// change it
		// http://localhost/citemplate/index.php/Users/validate/create
		$args = array("email_value"	=> "test@free.fr",
				"username_value" => "modified_test",
				"password" => "password",
				"password-confirm" => "password",
				"last_login" => "12/31/2000 00:00"
		);
		$output =  $this->request('POST', ['Users', 'validate', 'edit'], $args);
// 		$output =  $this->request('SET', ['Users', 'update', $id], $args);

		// read it
		$output =  $this->request('GET', ['Users', 'edit', $id]);
		$this->assertNotEquals("", $output, "Edit");
		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in User edit form");

		// delete it
		$output =  $this->request('GET', ['Users', 'delete', $id]);
		$new_count =  $this->model->count('users');
		$this->assertEquals($count, $new_count, "One user has been deleted");
	}

}
