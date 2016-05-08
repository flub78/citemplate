<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Controller_reset_server_test extends TestCase
{
	public function test_access_to_rest_server_page()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		$output = $this->request('GET', ['Rest_server', 'index']);
		# $this->assertContains('<title>Welcome to CodeIgniter</title>', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_unknown_method_returns_404()
	{
		$this->request('GET', ['Rest_server', 'method_not_exist']);
		$this->assertResponseCode(404);
	}

}
