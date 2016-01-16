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
class Meta_test2 extends MY_Controller {

	var $default_table = 'meta_test2';
	var $controller = 'meta_test2';
	var $form_fields = array('oaci', 'description');
// 	var $table_fields = array('name', 'description', 'expiration_date', '__edit', '__delete');
	var $table_fields; // = array_merge($form_field, array('__edit', '__delete'));

	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		// specific initialization
		$this->load->model('crud_model', 'model');
		$this->load->language("meta_test2");
		$this->table_fields = array_merge($this->form_fields, array('__edit', '__delete'));
	}

}
