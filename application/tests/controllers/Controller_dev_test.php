<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Controller_Dev_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
// 		# $this->CI->load->library('Ion_auth');
// 		if ($this->CI->ion_auth->logged_in()) {
// 		    $this->CI->ion_auth->logout();
// 		}
// 		$this->CI->ion_auth->login('admin', 'admin', true);
	}

	public function tearDown() {
// 	    if ($this->CI->ion_auth->logged_in()) {
// 		  $this->CI->ion_auth->logout();
// 	    }
	}

	public function test_phpinfo()
	{
		//$output = $this->request('GET', ['Dev', 'phpinfo']);
		$output = $this->request('GET', 'Dev/phpinfo');
		$this->screenshot($output, "phpinfo");
		$this->assertContains('PHP Version', $output);
	}

	public function test_info()
	{
		$output = $this->request('GET', ['Dev', 'info']);
		$this->assertContains('Base url', $output);
	}

	public function test_check_lang()
	{
		$output = $this->request('GET', ['Dev', 'check_lang', 'french', 1]);
		$this->assertContains('Reference language', $output);
	}

	public function test_unknown_method_returns_404()
	{
		$this->request('GET', ['Dev', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
