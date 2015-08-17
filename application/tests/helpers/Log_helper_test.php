<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 * 
 * Warning: The test only passes when log_threshold is not null the the config.php file.
 * 
 */

class Log_helper_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->helper('log');
	}
	
	/**
	 * Difficulty to test the log mechanism is that output are buffered.
	 */
	public function test_loaded()
	{
		$this->assertEquals(1, 1, 'Log helper is loaded');
		$logfile = logfile();
		# echo "logfile=$logfile \n";
		$this->assertEquals(true, file_exists($logfile), "Logfile $logfile exist");

		$count = log_count("INFO");
		# echo "count=$count\n";
		log_message("INFO", "trace from PHPUnit test");
		sleep(1);
		# echo "count=$count\n";
	}
}
