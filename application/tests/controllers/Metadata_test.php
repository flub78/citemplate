<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Metadata_test extends TestCase
{
	function __construct() {
		parent :: __construct();
		$this->resetInstance();
		$this->CI->load->library('ciauth');
		$this->CI->ciauth->login('testuser', 'testuser', true);
	}
	
	public function test_index()
	{
		$output = $this->request('GET', ['Metadata', 'index']);
		$this->assertContains('Welcome to This template application', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Metadata', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
