<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Metadata_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', ['Metadata', 'index']);
		$this->assertContains('Welcome to This template application', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_test()
	{
		$output = $this->request('GET', ['Metadata', 'test']);
		$this->assertCount(1, array('Passed'), "Good number of passed");
		$this->assertNotContains('A PHP Error was encountered', $output);
	}
	
	
	public function test_method_404()
	{
		$this->request('GET', ['Metadata', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
