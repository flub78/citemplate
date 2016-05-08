<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Controller_test_application_test extends TestCase
{
	public function test_index_method()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		// $output = $this->request('GET', ['Welcome', 'index']);
		$output = $this->request('GET', ['TestApplication', 'index']);
				
		// $this->assertContains('Welcome to', $output);
		$this->assertContains('test application', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);

	}

	public function test_unknown_method_returns_404()
	{
		$this->request('GET', ['TestApplication', 'method_not_exist']);
		$this->assertResponseCode(404);
	}
	
	public function test_about_method()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);
	
		// $output = $this->request('GET', ['Welcome', 'index']);
		$output = $this->request('GET', ['TestApplication', 'about']);
		
		// $this->assertContains('Welcome to', $output);
		$this->assertContains('A propos de CIT', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	
	}
	
}
