<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Feature_localisation_test extends TestCase
{
	public function test_switch_to_french()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);
	
		$output = $this->request('GET', ['Welcome', 'home']);
		$this->screenshot($output, "english_home");
		$this->assertContains('Welcome', $output, 'page in English');
		
		$lang = $this->CI->config->item('language');
		$this->assertEquals($lang, 'english', "English by default");
		
		$this->CI->config->set_item('language', 'french');
		$lang = $this->CI->config->item('language');
		$this->assertEquals($lang, 'french', "set to French");
		
		$output = $this->request('GET', ['Welcome', 'home']);
		$this->screenshot($output, "french_home");
		
		# $this->assertContains('<title>Welcome to CodeIgniter</title>', $output);
		$this->assertNotContains('A PHP Error was encountered', $output);
		$this->assertContains('Bienvenue', $output, 'page in French');
		
		$this->CI->config->set_item('language', 'english');
	}
	
}
