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
		$table = 'ciauth_user_privileges';
		$field = 'privilege_name';
		
		$datatable = datatable('crud');
		$expected = "";
		$this->assertEquals($expected,
			$datatable,
			'check that datable return nothing on non existing tables'
		);
		
		$expected = "";
		$actual = field_label_text($table, $field);
		$this->assertEquals($expected, $actual, 
			"field_label"
		);

		$expected = "";
		$actual = field_input($table, $field);
		$this->assertNotEquals($expected, $actual,
				"field_input"
		);

		$expected = "";
		$actual = form($table);
		$this->assertNotEquals($expected, $actual,
				"basic form: $actual not empty"
		);
		
		
	}
}
