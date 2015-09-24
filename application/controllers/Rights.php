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
	var $form_fields = array('privilege_name', 'privilege_description');
	var $table_fields = array('privilege_name', 'privilege_description', '__edit', '__delete');
	var $controller = 'rights';
	
// 	/**
// 	 * Constructor
// 	 */
// 	function __construct() {
// 		parent :: __construct();
// 		// specific initialization	
// 		$this->table_fields = array_merge($this->form_fields,  array('__edit', '__delete'));
// 	}
	
	
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
		$data['title'] = translation('New privilege');
		$data['controller'] = $this->controller;
		$data['action'] = "create";
		$data['table'] = $this->default_table;
		$data['values'] = array();
		$data['error_msg'] = "";
			$this->load->view('default_form', $data);
	}

	/**
	 * Edit an existing item
	 * @param unknown $id
	 */
	public function edit2($id) {
		$data = array();
		$this->display_form("");
	}
	
	/**
	 * Display a form to edit an existing element
	 * @param unknown $id
	 */
	public function edit($id) {
		// load data
		$id_field = table_key($this->default_table);
		
		$values = array($this->default_table => 
				$this->model->get_by_id($this->default_table, $id_field, $id));
		// var_dump($values);

		// set rules
		foreach ($this->form_fields as $field) {
			$name = field_name($this->default_table, $field);
			$label = field_label_text($this->default_table, $field);
			$rules = rules($this->default_table, $field);
			// echo "name=$name, label=$label, rules=$rules";
			$this->form_validation->set_rules($name, $label, $rules);
		}
		
		/*
		 * GVV
		 * get_by_id
		 * form_static_element: in place modifications
		 * all values passed to the view
		 * call or metadata form passing keys/values
		 * 
		 * use cases
		 *    - create with eventually some default values (converted from database to display (localisation))
		 *    - edit with values from the database (converted from database to display (localisation))
		 *    - repopulation from the form
		 *    - readonly
		 */
		
		$data = array();
		$data['title'] = translation('Privileges');
		$data['controller'] = $this->controller;
		$data['table'] = $this->default_table;
		$data['action'] = "edit/$id";
		$data['values'] = $values;
		$data['error_msg'] = "";
		
		if ($this->form_validation->run() == FALSE) {
			# invalid input, reload the form
			$this->load->view('default_form', $data);
		} else {
			# successful validation
		}
	}
		
}
