<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Ciauth_admin_test extends TestCase
{
	public function test_nav_admin()
	{
		$output = $this->request('GET', ['C_ciauth_admin', 'nav_admin']);
		$this->assertContains('Navigation Builder', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	
	public function test_method_404()
	{
		$this->request('GET', ['Metadata', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
