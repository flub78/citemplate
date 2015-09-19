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
	}
	
	public function test_all() {
		$methods = array('create');
		foreach ($methods as $method) {
			$id = 42;
			$output = $this->request('GET', ['Users', $method]);
			$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
		}	
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Users', 'unknow_method']);
		$this->assertResponseCode(404);
	}

}
