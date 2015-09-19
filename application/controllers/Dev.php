<?php
/**
 *    Project {$PROJECT}
 *    Copyright (C) 2015 {$AUTHOR}
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource Metadata.php
 * @package controllers
 * Development tools controler
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Development controller
 * @author frederic
 *
 */
class Dev extends MY_Controller {

	function __construct() {
		parent :: __construct();
	}
	
	/**
	 * Display phpinfo
	 */
	public function phpinfo()
	{
		phpinfo();
	}

	/**
	 * Display info
	 */
	public function info()
	{
		echo "base_url=" . base_url() . br();
		echo "site_url=" . site_url() . br();
		echo "current_url=" . current_url() . br();
	}
	
	/**
	 * Display information on ..
	 */
	public function test()
	{
		$fields = $this->db->field_data('ciauth_user_privileges');
		var_dump($fields);
	}
	
}
