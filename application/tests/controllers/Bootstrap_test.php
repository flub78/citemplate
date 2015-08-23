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
	public function test_starter()
	{
		$output = $this->request('GET', ['Bootstrap', 'starter']);
		$this->assertContains('Bootstrap starter', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
	}

	public function test_all() {
		$views = array('basic', 'blog', 'carousel', 'cover', 'dashboard', 'fixed_navbar', 'grids', 'jumbotron',
				'narrow_jumbotron', 'navbar', 'sign_in', 'starter', 'static_top_navbar', 'sticky_footer_with_navbar',
				'sticky_footer', 'theme');
		foreach ($views as $view) {
			$output = $this->request('GET', ['Bootstrap', $view]);
			$this->assertNotContains('A PHP Error was encountered', $output, "no PHP error in $view");
		}	
	}
	
	public function test_method_404()
	{
		$this->request('GET', ['Bootstrap', 'unknow_method']);
		$this->assertResponseCode(404);
	}

}
