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
class Rights extends MY_Controller {

	var $default_table = 'ciauth_user_privileges';
	var $controller = 'rights';
	var $form_fields = array('privilege_name', 'privilege_description');
	var $table_fields = array('privilege_name', 'privilege_description', '__edit', '__delete');
		
	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		// specific initialization
		$this->load->model('rights_model', 'model');
		
	}	
		
}
