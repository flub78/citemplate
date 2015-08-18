<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Bootstrap_test extends TestCase
{
	public function test_starter()
	{
		$output = $this->request('GET', ['Bootstrap', 'starter']);
		$this->assertContains('Bootstrap starter', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', ['Bootstrap', 'unknow_method']);
		$this->assertResponseCode(404);
	}

}
