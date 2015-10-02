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
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->ciauth->login('testuser', 'testuser', true);
	}
	
	public function tearDown() {
		$this->CI->ciauth->logout();
	}
	
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

	public function test_check_lang()
	{
		$output = $this->request('GET', ['Dev', 'check_lang', 'french', 1]);
		$this->assertContains('Reference language', $output);
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Dev', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
