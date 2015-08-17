<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Ciauth_test extends TestCase
{
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
	
	public function test_method_404()
	{
		$this->request('GET', ['Metadata', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
