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
 * @filesource Bootstrap.php
 * @package controllers
 * Experiment on Bootsrap framework
 */
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Metadata controller
 * @author frederic
 *
 */
class Bootstrap extends CI_Controller {

	function __construct() {
		parent :: __construct();
		$this->load->helper('metadata');
	}
	
	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = array();
		$this->load->view('bootstrap/basic', $data);
		
	}
	
	/**
	 * 
	 */
	public function starter() {
		$data = array();
		$this->load->view('bootstrap/starter', $data);
	}
	
	/**
	 *
	 */
	public function carousel() {
		$data = array();
		$this->load->view('bootstrap/carousel', $data);
	}
	
	/**
	 *
	 */
	public function dashboard() {
		$data = array();
		$this->load->view('bootstrap/dashboard', $data);
	}

	/**
	 *
	 */
	public function example($name) {
		$data = array();
		$this->load->view('bootstrap/' . $name, $data);
	}
	
}
