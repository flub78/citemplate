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
	
	var $title = array (
		'create' => 'New privilege',
		'edit' => 'Privilege'
	);
	
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
	 * Initialize the data to send to the form
	 * @param unknown $action
	 * @return multitype:
	 */
	protected function init_form($action) {
		$data = array();
		$data['title'] = translation($this->title[$action]);
		$data['controller'] = $this->controller;
		$data['action'] = $action;
		$data['table'] = $this->default_table;
		$data['error_msg'] = "";
		return $data;
	}
	
	/**
	 * Display a form to create a new element
	 */
	public function create() {
		$data = init_form("create");
		$data['values'] = array();		# TODO should be default values
		$this->load->view('default_form', $data);
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
		
		$data = init_form("edit");
		$data['values'] = $values;
		
		$this->load->view('default_form', $data);
	}
	
	/**
	 * Display a form to edit an existing element
	 * @param unknown $id
	 */
	public function validate($action, $id = "") {

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
		
		
		if ($this->form_validation->run() == FALSE) {
			// invalid input, reload the form

			$data = init_form($action);				
			$data['values'] = array();
			$this->load->view('default_form', $data);
			
		} else {
			# successful validation
			echo "validation success";
			$values = array();
			foreach ($this->form_fields as $field) {
				$field_name = field_name($this->default_table, $field);
				$values[$field] = $this->input->post($field_name);
			}
			var_dump($values);
			
			if ($action == "edit") {
				# update
				
			} else {
				# create
				
			}
		}
	}
		
}
