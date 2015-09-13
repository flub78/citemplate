<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Bootstrap_test extends TestCase
{

	function __construct() {
		parent :: __construct();
		$this->resetInstance();
		$this->CI->load->library('ciauth');
		$this->CI->ciauth->login('testuser', 'testuser', true);
	}
	
	public function test_all() {
		$views = array('basic', 'blog', 'carousel', 'cover', 'dashboard', 'grids', 'jumbotron',
				'narrow_jumbotron', 'sign_in', 'sticky_footer_with_navbar',
				'theme');
		
		foreach ($views as $view) {
			echo "testing $view";
			$output = $this->request('GET', ['Bootstrap', $view]);
			echo "output=$ouput";
			$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $view");
		}	
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Bootstrap', 'unknow_method']);
		$this->assertResponseCode(404);
	}

}
