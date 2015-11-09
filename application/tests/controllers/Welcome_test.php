<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Welcome_controller_test extends TestCase
{
	public function test_index()
	{
		$this->resetInstance();
		$this->CI->load->library('ciauth');
		$this->CI->ciauth->login('testuser', 'testuser', true);
		
		$output = $this->request('GET', ['Welcome', 'index']);
		# $this->assertContains('<title>Welcome to CodeIgniter</title>', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
		
		$output = $this->request('GET', ['Welcome', 'home']);
		$this->assertNotContains('A PHP Error was encountered', $output);
		
		$output = $this->request('GET', ['Welcome', 'login']);
		$this->assertNotContains('A PHP Error was encountered', $output);
		
		$output = $this->request('GET', ['Welcome', 'about']);
		$this->assertNotContains('A PHP Error was encountered', $output);
		
		# To improve coverage and go through not log in branches
		$output = $this->request('GET', ['Welcome', 'logout']);
		$output = $this->request('GET', ['Welcome', 'about']);
		$output = $this->request('GET', ['Welcome', 'home']);
		
	}

	public function test_method_404()
	{
		$this->request('GET', ['Welcome', 'method_not_exist']);
		$this->assertResponseCode(404);
	}

	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}
}
