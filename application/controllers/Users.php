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
 * @filesource Crud.php
 * @package controllers
 * Controler for ...
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users controller
 * @author frederic
 *
 */
class Users extends MY_Controller {

	// var $default_table = 'users_view';
	var $default_table = 'users';
	var $default_view = 'users_view';
	var $controller = 'users';
	var $table_fields = array('image', 'username', 'email', 'active', 'created_on', 'last_login', '__edit', '__delete');
	// var $table_fields = array('first_name', 'last_name', 'username', 'email', 'active', 'created_on', 'last_login', '__edit', '__delete');
	var $form_fields = array(
		'create' => array('first_name', 'last_name', 'username', 'company', 'email', 'phone', 'password', 'confirm-password'),
		'edit' =>  array('first_name', 'last_name', 'email', 'username', 'phone', 'password', 'confirm-password', 'active', 'created_on', 'last_login')
	);

	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		// specific initialization
		$this->load->model('users_model', 'model');
	}

	/**
	 * Add a new element
	 *
	 * Special version because the password must be encoded
	 */
	public function add($data = array()) {
		// echo "creating user :" . var_export($data, true);exit;
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		$this->model->create('users', $data);

		redirect(controller_url($this->controller));
	}

	/**
	 * Update an element
	 *
	 * Special version because the password may be empty when
	 * it is not modified.
	 */
	public function update($id, $data = array()) {

		if (isset($data['password']) && ($data['password'] != "")) {
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		} else {
			unset($data['password']);
		}
		$id_field = table_key($this->default_table);
		$this->model->update($this->default_table, $id_field, $data, $id);
		redirect(controller_url($this->controller));
	}

	/**
	 * Display a form to create a new element
	 */
	public function create() {

		$data = array();
		$data['title'] = translation('Please Register');
		$data['controller'] = $this->controller;
		$data['action'] = "create";
		$data['table'] = $this->default_table;
		$data['values'] = element_default_values($this->default_table);
		$data['field_list'] = $this->form_fields['create'];
		$data['error_msg'] = "";
		$data['submit_label'] = 'button_submit_register';
		$this->load->view('default_form', $data);
	}

	/**
	 * Form validation callback
	 *
	 * @param unknown $str
	 * @return boolean
	 */
	public function null_or_min_length($str, $size)
	{
		if ($str == '' or strlen($str) >= $size)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('password', 'The {field} length must be at least 5');
			return FALSE;
		}
	}

}
