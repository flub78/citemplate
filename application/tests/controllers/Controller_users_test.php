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

	public function test_unknown_method_returns_404()
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
		$args = array(
		        "first_name" => "John",
		        "last_name" => "Doe",
				"username_value" => "test",
		        "company" => "World Wide",
		        "email_value"	=> "test@free.fr",
		        "phone" => "0123456789"
		);
		$output =  $this->request('POST', ['users', 'validate', 'create'], $args);
		$error = 'The Password field is required';
		$this->assertContains($error, $output, "Error reported when missing password");

// 		echo "\nuser with no password validated";


		$args = array(
		        "first_name" => "John",
		        "last_name" => "Doe",
				"username_value" => "test",
		        "company" => "World Wide",
		        "email_value"	=> "test@free.fr",
		        "phone" => "0123456789",
		        "password" => "password314",
		        "confirm-password" => "password314"
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
	
	/**
	 * when called by the WEB application:
	 * 
	 * users.update id=3

data = array (size=9)
  'first_name' => string 'admin_firstname_0' (length=17)
  'last_name' => string 'admin_name_0 modified' (length=21)
  'email' => string 'user_0@gmail.com' (length=16)
  'username' => string 'user_0' (length=6)
  'phone' => string 'testadmin' (length=9)
  'password' => string 'password' (length=8)
  'active' => string '1' (length=1)
  'created_on' => int 1463166677
  'last_login' => int 1463090400

$_POST = array (size=11)
  'first_name' => string 'admin_firstname_0' (length=17)
  'last_name' => string 'admin_name_0 modified' (length=21)
  'email_value' => string 'user_0@gmail.com' (length=16)
  'username_value' => string 'user_0' (length=6)
  'phone' => string 'testadmin' (length=9)
  'password' => string 'password' (length=8)
  'confirm-password' => string '' (length=0)
  'active' => string '1' (length=1)
  'created_on' => int 1463166677
  'last_login' => int 1463090400
  'submit' => string 'submit' (length=6)
 
	 */
	function test_update() {

		$args = array (
  			'first_name' => 'admin_firstname_0',
  			'last_name' => 'admin_name_0 modified',
  			'email' => 'user_0@gmail.com',
  			'username' => 'user_0',
  			'phone' => 'testadmin',
  			'password' => 'password',
  			'active' => '1',
  			'created_on' => 1463166677,
  			'last_login' => 1463090400);
		
		$post = array(
				"first_name" => "John",
				"last_name" => "Doe",
				"username_value" => "test",
				"company" => "World Wide",
				"email_value"	=> "test@free.fr",
				"phone" => "0123456789",
				'password' => 'password',
				'confirm-password' => 'password',
				'active' => '1',
				'created_on' => 1463166677,
				'last_login' => 1463090400,
				'submit' => 'submit'
		);
		$output =  $this->request('POST', ['users', 'update', '3', $args], $post);
		
		// nothing to test. Only database query may demonstrate that the test is OK
	}

}
