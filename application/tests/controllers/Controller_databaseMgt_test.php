<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Controller_DatabaseMgt_test extends TestCase
{
	public function test_save()
	{
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);

		$output = $this->request('GET', ['DatabaseMgt', 'restore']);
		$this->assertNotContains('A PHP Error was encountered', $output);

		$output = $this->request('GET', ['DatabaseMgt', 'migration']);
		$this->assertNotContains('A PHP Error was encountered', $output);

		$output = $this->request('POST', ['DatabaseMgt', 'do_restore']);

	}

	public function test_reset() {
		$this->resetInstance();
		$this->CI->load->library('Ion_auth');
		$this->CI->ion_auth->login('admin', 'admin', true);
				
		$output = $this->request('GET', ['DatabaseMgt', 'reset']);
		
		$this->CI->db->close();
		$this->CI->load->database();
		
		$this->CI->load->library('Database');
		$this->database = new Database();
		
		// to reload a test database
		$this->database->restore('./application/tests/test_database_1.sql', 'ci3', 'ci3', 'ci3', true);
		$tables = $this->database->show_tables();
		$this->assertEquals(7, count($tables), "7 tables after reload");
		
	}
}
