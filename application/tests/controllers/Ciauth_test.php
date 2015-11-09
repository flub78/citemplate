<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Ciauth_controller_test extends TestCase
{
// 	function setUp(){
// 		@session_start();
// 		parent::setUp();
// 	}
	
	public function test_index()
	{
		$output = $this->request('GET', ['C_ciauth', 'index']);
		$this->assertContains('CIAUTH DEMO', $output);
		$this->assertContains('Glen Barnhardt', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_register()
	{
		$output = $this->request('GET', ['C_ciauth', 'register']);
		$this->assertContains('Please Register', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_login()
	{
		$output = $this->request('GET', ['C_ciauth', 'login']);
		$this->assertContains('Please sign in', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_logout()
	{
		$output = $this->request('GET', ['C_ciauth', 'logout']);
		# $this->assertContains('Login', $output);
		# $this->assertNotContains('A PHP Error was encountered', $output);
	}
	
// 	public function test_about()
// 	{
// 		$output = $this->request('GET', ['C_ciauth', 'about']);
// 		$this->assertContains('About', $output);
// 		$this->assertNotContains('A PHP Error was encountered', $output);
// 	}

	public function test_recaptcha()
	{
		$output = $this->request('GET', ['C_ciauth', 'recaptcha']);
	}

	public function test_registration()
	{
		$output = $this->request('GET', ['C_ciauth', 'registration']);
	}
	
	public function test_process_login_form_ajax()
	{
		$output = $this->request('GET', ['C_ciauth', 'process_login_form_ajax']);
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Metadata', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
