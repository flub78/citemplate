<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Rights_test extends TestCase
{

	public function setUp()
	{
		parent :: __construct();
		$this->resetInstance();
		$this->CI->ciauth->login('testuser', 'testuser', true);

		// Also load the model, controller test a a little more than unit tests
		$this->CI->load->model('crud_model', 'model');
        $this->model = $this->CI->model;
	}

	public function tearDown() {
		$this->CI->ciauth->logout();
	}
	
	public function test_all() {
		$methods = array('index', 'create');
		foreach ($methods as $method) {
			$id = 42;
			$output = $this->request('GET', ['Rights', $method]);
			$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
		}	
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Rights', 'unknow_method']);
		$this->assertResponseCode(404);
	}

	public function test_crud()
	{
		# Check create form
		$output =  $this->request('GET', ['Rights', 'create']);
		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
		
		# Actually create something
        $count =  $this->model->count('ciauth_user_privileges');
        
		$args = array("privilege_description"	=> "For super hero",
					"privilege_name" => "Superpower",
					"submit" => "submit");
		// http://localhost/citemplate/index.php/rights/validate/create
 		$output =  $this->request('POST', ['Rights', 'validate', 'create'], $args);
 		$id = $this->model->get_last_inserted();
 		// file_put_contents ("/tmp/output.html", $output);
 		$this->assertEquals("", $output, "POST create should not return anything ???");
 		
 		$new_count =  $this->model->count('ciauth_user_privileges');
 		$this->assertEquals($count +1, $new_count, "One privilege has been created");
 		
 		// change it
 		$args = array("privilege_description"	=> "For really super hero",
 				"privilege_name" => "Superpower",
 				"privilege_id" => $id,
 				"submit" => "submit");
 		// http://localhost/citemplate/index.php/rights/validate/create
 		$output =  $this->request('POST', ['Rights', 'validate', 'edit'], $args);
 		
 		// read it
 		$output =  $this->request('GET', ['Rights', 'edit', $id]);
 		$this->assertNotEquals("", $output, "Edit");
 		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
 			
		// delete if
 		$output =  $this->request('GET', ['Rights', 'delete', $id]);
 		$new_count =  $this->model->count('ciauth_user_privileges');
 		$this->assertEquals($count, $new_count, "One privilege has been deleted");
	}
	
}
