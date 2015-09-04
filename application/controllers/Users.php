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
 * Metadata controller
 * @author frederic
 *
 */
class Crud extends CI_Controller {

	var $logger;
	
	function __construct() {
		parent :: __construct();
		$this->load->helper('metadata');
		$this->load->library('logger');	

		$this->logger = new Logger("class=" . get_class($this));
		$this->logger->debug('New instance of ' . get_class($this));
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
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
		$this->load->view('default_form', $data);
	}

	/**
	 * Display a form to edit an existing element
	 * @param unknown $id
	 */
	public function edit($id) {
		$data = array();
		$this->load->view('default_form', $data);
	}

	/**
	 * Display a form to edit an existing element
	 * @param unknown $id
	 */
	public function delete($id) {
	
	}
		
}
