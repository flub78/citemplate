<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Helper_metadata_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->helper('metadata');
		$this->CI->lang->load('application');
        $this->CI->load->model('crud_model', 'model');
	}

	public function test_loaded()
	{
		$table = 'groups';
		$field = 'name';

		$datatable = datatable('crud');
		$expected = "";
		$this->assertEquals($expected,
			$datatable,
			'check that datable return nothing on non existing tables'
		);

		$expected = "Group name";
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
