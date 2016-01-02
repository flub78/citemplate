<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Groups_controller_test extends TestCase
{

	public function setUp()
	{
		parent :: __construct();
		$this->resetInstance();
		$this->CI->ion_auth->login('admin', 'admin', true);

		// Also load the model, controller test a a little more than unit tests
		$this->CI->load->model('crud_model', 'model');
        $this->model = $this->CI->model;
	}

	public function tearDown() {
		$this->CI->ion_auth->logout();
	}

	public function test_all() {
		$methods = array('index', 'create');
		foreach ($methods as $method) {
			$output = $this->request('GET', ['Groups', $method]);
			$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
		}
	}

	public function test_method_404()
	{
		$this->request('GET', ['Groups', 'unknow_method']);
		$this->assertResponseCode(404);
	}

	public function test_crud()
	{
		# Check create form
		$output =  $this->request('GET', ['Groups', 'create']);
		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");

		# Actually create something
        $count =  $this->model->count('groups');

		$args = array("description"	=> "For super hero",
					"name" => "Superpower",
					"submit" => "submit");
		// http://localhost/citemplate/index.php/Groups/validate/create
 		$output =  $this->request('POST', ['Groups', 'validate', 'create'], $args);
 		$id = $this->model->get_last_inserted();
 		// file_put_contents ("/tmp/output.html", $output);
 		$this->assertEquals("", $output, "POST create should not return anything ???");

 		$new_count =  $this->model->count('groups');
 		$this->assertEquals($count +1, $new_count, "One group has been created");

 		// change it
 		$args = array("description"	=> "For really super hero",
 				"name" => "Superpower",
 				"id" => $id,
 				"submit" => "submit");
 		// http://localhost/citemplate/index.php/Groups/validate/create
 		$output =  $this->request('POST', ['Groups', 'validate', 'edit'], $args);

 		// read it
 		$output =  $this->request('GET', ['Groups', 'edit', $id]);
 		$this->assertNotEquals("", $output, "Edit");
 		$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in edit");

		// delete if
 		$output =  $this->request('GET', ['Groups', 'delete', $id]);
 		$new_count =  $this->model->count('groups');
 		$this->assertEquals($count, $new_count, "One group has been deleted");
	}

}
