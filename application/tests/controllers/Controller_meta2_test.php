<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Meta2_controller_test extends TestCase
{
	public function test_index()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		$output = $this->request('GET', ['Meta_test2', 'index']);
		# $this->assertContains('<title>Welcome to CodeIgniter</title>', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', ['Meta_test2', 'method_not_exist']);
		$this->assertResponseCode(404);
	}

}
