<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class DatabaseMgt_controller_test extends TestCase
{
	public function test_save()
	{
		$this->resetInstance();
		$this->CI->load->library('ciauth');
		$this->CI->ciauth->login('testuser', 'testuser', true);
		
//  		$output = $this->request('GET', ['DatabaseMgt', 'backup', 'structure']);
// 		$this->assertNotContains('A PHP Error was encountered', $output);
		
		$output = $this->request('GET', ['DatabaseMgt', 'restore']);
		$this->assertNotContains('A PHP Error was encountered', $output);		

		$output = $this->request('GET', ['DatabaseMgt', 'migration']);
		$this->assertNotContains('A PHP Error was encountered', $output);		

		$output = $this->request('POST', ['DatabaseMgt', 'do_restore']);
		
	}

}
