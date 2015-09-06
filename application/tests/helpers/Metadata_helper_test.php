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
		
		$data_table = datatable("crud");
		$expected = "";
		$this->assertEquals($expected,
			$datatable,
			'datatable helper'
		);
		
		$expected = "";
		$actual = field_label('language');
		$this->assertEquals($expected, $actual, 
			"field_label"
		);

		$expected = "";
		$actual = field_input('language');
		$this->assertEquals($expected, $actual,
				"field_input"
		);

		$expected = "";
		$actual = form('language');
		$this->assertNotEquals($expected, $actual,
				"basic form: $actual not empty"
		);
		
		
	}
}
