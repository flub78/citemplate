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

	var $logger;
	
	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		$this->load->model('crud_model', 'rights');		
	}
	
	/**
	 * Index Page for this controller.
	 *
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
		$data['table_title'] = translation('title_rights');
		
		$select = $this->rights->select_all('ciauth_user_privileges');

		$attrs['fields'] = array('privilege_name', 'privilege_description', '__edit', '__delete');
		$attrs['controller'] = 'rights';
		$data['data_table'] = datatable('ciauth_user_privileges', $select, $attrs);
		
		$this->load->view('default_table', $data);
	}
	
	/**
	 * Add a new element 
	 */
	public function add($data = array()) {
		
	}
	
	/**
	 * Display a form to create a new element
	 */
	public function create() {
		$data = array();
		$data['title'] = translation('Please Register');
		$this->load->view('default_form', $data);
	}

	/**
	 * Display a form to edit an existing element
	 * @param unknown $id
	 */
	public function edit($id) {
		$data = array();
		$data['title'] = translation('Please Register');
		$this->load->view('default_form', $data);
	}

	/**
	 * Display a form to edit an existing element
	 * @param unknown $id
	 */
	public function delete($id) {
		echo "delete $id";
	}
		
}
