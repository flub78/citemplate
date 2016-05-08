<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Controller_Meta1_test extends TestCase
{
	public function test_index()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		$output = $this->request('GET', ['Meta_test1', 'index']);
		# $this->assertContains('<title>Welcome to CodeIgniter</title>', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_unknown_method_returns_404()
	{
		$this->request('GET', ['Meta_test1', 'method_not_exist']);
		$this->assertResponseCode(404);
	}

}
