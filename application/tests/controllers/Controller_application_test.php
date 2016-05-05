<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Welcome_application_test extends TestCase
{
	public function test_index()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		// $output = $this->request('GET', ['Welcome', 'index']);
		$output = $this->request('GET', ['Testtest', 'index']);
				
		// $this->assertContains('Welcome to', $output);
		$this->assertContains('test application', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);

	}

	public function test_method_404()
	{
		$this->request('GET', ['Welcome', 'method_not_exist']);
		$this->assertResponseCode(404);
	}
	
	public function test_about()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);
	
		// $output = $this->request('GET', ['Welcome', 'index']);
		$output = $this->request('GET', ['Testtest', 'about']);
		
		// $this->assertContains('Welcome to', $output);
		$this->assertContains('A propos de CIT', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	
	}
	

}
