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
		$this->CI->lang->load('application');
	}
	
	/**
	 * Difficulty to test the log mechanism is that output are buffered.
	 */
	public function test_values()
	{
		$actual = script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js');
//  		echo $actual;
 		$expected = '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
 		$this->assertEquals($expected, $actual, $expected);
 		
	}
	
	public function test_translation() {
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
	
	public function test_p() {
		$expected = '<p></p>';
		$res = p("");
 		$this->assertEquals($expected, $res, 'p("")');

 		$expected = '<p>Hello world</p>';
 		$res = p("Hello world");
 		$this->assertEquals($expected, $res, 'p("Hello world")');
 		
 		$expected = '<p class="error">Hello world</p>';
 		$res = p("Hello world", 'class="error"');
 		$this->assertEquals($expected, $res, "p(\"Hello world\", 'class=\"error\"')"); 			
	}
}
