<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Rights_test extends TestCase
{

	public function test_all() {
		$methods = array('index', 'create');
		foreach ($methods as $method) {
			$id = 42;
			$output = $this->request('GET', ['Rights', $method]);
			$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $method");
		}	
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Rights', 'unknow_method']);
		$this->assertResponseCode(404);
	}

}
