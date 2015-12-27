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

class Helper_url_test extends TestCase
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
		
		$project_css = project_css('layout');
	    $bootstrap_css = bootstrap_css('bootstrap.min');
	    $theme_css = theme_css('flower');
	    
	    $project_js = project_js();
	    $bootstrap_js = bootstrap_js();
	    $theme_js = theme_js();
	    
		$theme_url = theme_url();
 		
 		$image_dir = image_dir();
 		$img_url = img_url();
 		$assert_url = asset_url();
 		$controller_url = controller_url();
 		$jqueryui_theme = jqueryui_theme();

//  		echo $bootstrap_css;
 		$ref = 'http://localhost/citemplate/css/layout.css';
 		$this->assertEquals($ref, $project_css, $ref);
 		
 		$ref = 'http://localhost/citemplate/components/bootstrap/css/bootstrap.min.css';
 		$this->assertEquals($ref, $bootstrap_css, $ref);
	}
}
