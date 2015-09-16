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

class Bootstrap_helper_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->helper('bootstrap');
		$this->CI->lang->load('application');
	}
	
	/**
	 * Test Bootstrap buttons
	 */
	public function test_button()
	{
		$actual = anchor_button('xxx');
 		$expected = '';
 		$this->assertNotEquals($expected, $actual, 'test button');
 		
	}
	
}
