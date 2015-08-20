<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Dev_test extends TestCase
{
	public function test_phpinfo()
	{
		$output = $this->request('GET', ['Dev', 'phpinfo']);
		$this->assertContains('PHP Version', $output);
	}

	public function test_info()
	{
		$output = $this->request('GET', ['Dev', 'info']);
		$this->assertContains('base_url', $output);
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Dev', 'index']);
		$this->assertResponseCode(404);
	}

}
