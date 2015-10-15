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
	
	var $default_table = 'ciauth_user_accounts';
	var $controller = 'users';
	var $table_fields = array('username', 'email', '__edit', '__delete');
	var $form_fields = array('email', 'username', 'password', 'confirm-password');
	
	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		// specific initialization
		$this->load->model('crud_model', 'model');
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
		$data['values'] = array();
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
		if ($str == '' or lenght($str) >= $size)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
			return FALSE;
		}
	}
	
}
