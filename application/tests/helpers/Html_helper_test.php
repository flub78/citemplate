<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 * 
 */

class Html_helper_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->helper('html');
	}
	
	/**
	 * Difficulty to test the log mechanism is that output are buffered.
	 */
	public function test_values()
	{
		$actual = script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js');
 		echo $actual;
 		$ref = '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
 		$this->assertEquals($ref, $actual, $ref);
 		
	}
}
