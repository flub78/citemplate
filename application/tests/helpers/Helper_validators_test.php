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

class Helper_validators_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->helper('validators');
	}
	
	/**
	 * Could be generic
	 * OO approach would be to create a validator object with a validate method
	 * and a factory. It looks kind of over-engineering ...
	 * @param unknown $date
	 * @param unknown $yes
	 */
	protected function is_valid_item($date, $yes, $name = 'date', $validator = 'valid_date') {
		$valid = $validator($date);
		$result = ($valid) ? true : false;
		if ($yes) {
			$msg = "$date is a valid $name";
			$this->assertTrue($result, $msg);
	
		} else {
			$msg = "$date is not a valid $name";
			$this->assertFalse($result, $msg);
	
		}
	}
	
	/**
	 * Could be generic
	 * OO approach would be to create a validator object with a validate method
	 * and a factory. It looks kind of over-engineering ...
	 * @param unknown $date
	 * @param unknown $yes
	 */
	protected function is_valid_date($date, $yes) {
		return $this->is_valid_item($date, $yes, 'date', 'valid_date');
	}
	
	/**
	 * Difficulty to test the log mechanism is that output are buffered.
	 */
	public function test_valid_date()
	{		
		$this->is_valid_date('', true);
		$this->is_valid_date('23/07/2017', false);
		$this->is_valid_date('07/23/2017', true);
		
	}
	
	protected function is_valid_timestamp($ts, $yes) {
		return $this->is_valid_item($ts, $yes, 'timestamp', 'valid_timestamp');
	}
	
	/**
	 * Difficulty to test the log mechanism is that output are buffered.
	 */
	public function test_valid_timestamp()
	{
		$this->is_valid_timestamp('', true);
		$this->is_valid_timestamp('05/11/2016 00:00', true);
		
		$this->is_valid_timestamp('05/11/aaa0:00', false);
	}

	protected function is_valid_time($t, $yes) {
		return $this->is_valid_item($t, $yes, 'time', 'valid_time');
	}
	
	/**
	 * Difficulty to test the log mechanism is that output are buffered.
	 */
	public function test_valid_time()
	{
		$this->is_valid_time('', false);
		$this->is_valid_time('00:00', true);
	
		$this->is_valid_time('zorglub', false);
	}
	
}
