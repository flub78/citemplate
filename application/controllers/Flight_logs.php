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
 * @filesource FlightLogs.php
 * @package controllers
 *
 * Example of a REST client
 *
 * "http://live.glidernet.org/flightlog/";
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rights controller
 * @author frederic
 *
 */
class Flight_logs extends MY_Controller {

	var $default_table = 'groups';
	var $controller = 'groups';
	var $form_fields = array('name', 'description');
	var $table_fields = array('name', 'description', '__edit', '__delete');

	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		// specific initialization
		$this->load->model('groups_model', 'model');

	}

	/**
	 * Select the flight logs to display
	 */
	function select() {
        $data = array('title' => 'Flight logs select');
        $this->load->view('flight_logs/select', $data);
	}

	/**
	 * Display the flight logs for a airfield and a date
	 */
	function display() {

	}

}
