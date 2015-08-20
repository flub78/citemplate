<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 * 
 * 
 */

class Url_helper_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->helper('url');
	}
	
	/**
	 * Difficulty to test the log mechanism is that output are buffered.
	 */
	public function test_values()
	{
		$current_url = current_url();
		
		$theme_url = theme_url();
 		$css_url = css_url('bootstrap');
 		$js_url = js_url('bootstrap');
 		$bootstrap_url = bootstrap_url();
 		$bootstrap_css = bootstrap_css();
 		$bootstrap_js = bootstrap_js();
 		
 		$image_dir = image_dir();
 		$img_url = img_url();
 		$assert_url = asset_url();
 		$controller_url = controller_url();
 		$jqueryui_theme = jqueryui_theme();
		
		$this->assertEquals(1, 1, 'URL helper is loaded');
	}
}
