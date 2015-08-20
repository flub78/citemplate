<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Ciauth_datatables_test extends TestCase
{
	public function test_pages()
	{
// 		$output = $this->request('GET', ['C_ciauth_data_tables', 'pages_ajax']);
// 		echo $output;
// 		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	
	public function test_method_404()
	{
		$this->request('GET', ['C_ciauth_data_tables', 'undefined_method']);
		$this->assertResponseCode(404);
	}

}
