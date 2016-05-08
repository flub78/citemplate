<?php
/**
 * Part of CI template test
 *
 * @author     flub78
 * @license    MIT License
 * @copyright  2015 Frédéric Peignot
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Controller_Bootstrap_test extends TestCase
{

	function __construct() {
		parent :: __construct();
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);
	}

	public function test_all() {
		$views = array('basic', 'blog', 'carousel', 'cover', 'dashboard', 'grids', 'jumbotron',
				'narrow_jumbotron', 'sign_in', 'sticky_footer_with_navbar',
				'theme');

		foreach ($views as $view) {
			# echo ("\ntesting $view");
			$output = $this->request('GET', ['Bootstrap', $view]);
			if (isset($output)) {
				$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $view");
			}
		}
	}

	public function test_unknown_method_returns_404()
	{
		$this->request('GET', ['Bootstrap', 'unknow_method']);
		$this->assertResponseCode(404);
	}

}
