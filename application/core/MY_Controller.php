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
 * This controller implement a basic CRUD
 * 
 * @filesource MY_Controller.php
 * @package controllers
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller controller
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
		$id_field = table_key($this->default_table);
		$this->model->delete($this->default_table, array($id_field  => $id));
		redirect(controller_url($this->controller));
	}
	
	/**
	 * Add a new element
	 */
	public function add($data = array()) {
		$this->model->create($this->default_table, $data);
		redirect(controller_url($this->controller));
	}

	/**
	 * Update an element
	 */
	public function update($id, $data = array()) {
		$id_field = table_key($this->default_table);
		$this->model->update($this->default_table, $id_field, $data, $id);
		redirect(controller_url($this->controller));
	}
	
	/**
	 * Initialize the data to send to the form
	 * @param unknown $action
	 * @return multitype:
	 */
	protected function init_form($action, $id = "") {
		$data = array();
		$data['title'] = form_title($this->default_table, $action); 
		$data['controller'] = $this->controller;
		$data['action'] = ($id) ? "$action/$id" : $action;
		$data['table'] = $this->default_table;
		$data['error_msg'] = "";
		if ($action == 'create') {
			$data['submit_label'] = 'button_submit_create';
		} else {
			$data['submit_label'] = 'button_submit_edit';				
		}
		return $data;
	}

	/**
	 * Display a form to create a new element
	 */
	public function create() {
		$data = $this->init_form("create");
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
	
		$data = $this->init_form("edit", $id);
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
			$rules = rules($this->default_table, $field, $action);
			// echo "name=$name, label=$label, rules=$rules";
			
			// On some fields like password on edit, some rules must be applied only
			// if the field is set.
			if ($rules) {
				$this->form_validation->set_rules($name, $label, $rules);
			}
		}	
	
		if ($this->form_validation->run() == FALSE) {
			// invalid input, reload the form
	
			$data = $this->init_form($action);
			$data['values'] = array();
			$this->load->view('default_form', $data);
				
		} else {
			# successful validation
			$values = array();
			foreach ($this->form_fields as $field) {
				if ($this->metadata->field_exists($this->default_table, $field)) {
					$field_name = field_name($this->default_table, $field);
					$values[$field] = $this->input->post($field_name);
				}
			}
			# var_dump($values);
				
			if ($action == "edit") {
				# update
				$this->update($id, $values);
	
			} else {
				# create
				$this->add($values);
			}
		}
	}
	
}
