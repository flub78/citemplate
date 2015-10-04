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
 * @filesource Rights.php
 * @package controllers
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rights controller
 * @author frederic
 *
 */
class Database extends MY_Controller {

	var $logger;
	
	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		$this->load->library('Database');
	}
	
	/**
	 * Save the database
	 * @param $action = backup|structure|default
	 */
	function backup ($action = 'backup') {
		echo "database backup";
	}	

	/**
	 * Restore the database
	 */
	function restore () {
	
	}

	/**
	 * Migration of the database
	 */
	function migration() {
	
	}
	
	
	
}
