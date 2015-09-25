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
class MY_Controller extends CI_Controller {

	var $logger;
	
	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		
		$this->logger = new Logger("class=" . get_class($this));
		$this->logger->debug('New instance of ' . get_class($this));
		
		if (!$this->ciauth->is_logged_in()) {
			redirect(controller_url('welcome/login'));
		}
		
		// load common model
		$this->load->model('crud_model', 'model');
	}
	
	/**
	 * Default is to list all elements
	 */
	public function index()
	{
		$this->all();
	}
	
	/**
	 * List of elements
	 */
	public function all() {
	
		$data = array();
		$data['table_title'] = table_title($this->default_table);
		$select = $this->model->select_all($this->default_table);
	
		$attrs['fields'] = $this->table_fields;
		$attrs['controller'] = $this->controller;
		$data['controller'] = $this->controller;
		$data['data_table'] = datatable($this->default_table, $select, $attrs);
	
		$this->load->view('default_table', $data);
	}
	
	/**
	 * Delete an element
	 * @param unknown $id
	 */
	public function delete($id) {
		echo "delete $id";
	}
	
		
}
