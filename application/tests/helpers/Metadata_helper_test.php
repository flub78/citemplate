<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Metadata_helper_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->helper('metadata');
		$this->CI->lang->load('application');
	}
	
	public function test_loaded()
	{
		$this->assertEquals("Fred",
			translation('Fred'),
			'Identity when not found'
		);
		$expected = "english";
		$actual = translation('language');
		$this->assertEquals($expected, $actual, 
			"Translated when found, $expected == $actual"
		);
	}
}
