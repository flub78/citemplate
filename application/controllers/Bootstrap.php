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
	public function basic()
	{
		$data = array();
		$this->load->view('bootstrap/basic', $data);

	}

	public function index() {
		$this->basic();
	}

	/**
	 * Index Page for this controller.
	 */
	public function blog()
	{
		$data = array();
		$this->load->view('bootstrap/blog', $data);

	}

	/**
	 *
	 */
	public function carousel() {
		$data = array();
		$this->load->view('bootstrap/carousel', $data);
	}

	/**
	 * Index Page for this controller.
	 */
	public function cover()
	{
		$data = array();
		$this->load->view('bootstrap/cover', $data);

	}

	/**
	 *
	 */
	public function dashboard() {
		$data = array();
		$this->load->view('bootstrap/dashboard', $data);
	}

	/**
	 * Index Page for this controller.
	 */
	public function fixed_navbar()
	{
		$data = array();
		$this->load->view('bootstrap/fixed_navbar', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function grids()
	{
		$data = array();
		$this->load->view('bootstrap/grids', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function jumbotron()
	{
		$data = array();
		$this->load->view('bootstrap/jumbotron', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function narrow_jumbotron()
	{
		$data = array();
		$this->load->view('bootstrap/narrow_jumbotron', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function navbar()
	{
		$data = array();
		$this->load->view('bootstrap/navbar', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function sign_in()
	{
		$data = array();
		$this->load->view('bootstrap/sign_in', $data);

	}


	/**
	 *
	 */
	public function starter() {
		$data = array();
		$this->load->view('bootstrap/starter', $data);
	}

	/**
	 * Index Page for this controller.
	 */
	public function static_top_navbar()
	{
		$data = array();
		$this->load->view('bootstrap/static_top_navbar', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function sticky_footer_with_navbar()
	{
		$data = array();
		$this->load->view('bootstrap/sticky_footer_with_navbar', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function sticky_footer()
	{
		$data = array();
		$this->load->view('bootstrap/sticky_footer', $data);

	}

	/**
	 * Index Page for this controller.
	 */
	public function theme()
	{
		$data = array();
		$this->load->view('bootstrap/theme', $data);

	}

	/**
	 *
	 */
	public function example($name) {
		$data = array();
		$this->load->view('bootstrap/' . $name, $data);
	}

	/**
	 * Openclassroom Bootstrap tutorial
	 */
	public function tuto1() {
		$data = array();
		$this->load->view('bootstrap/tuto1', $data);
	}

	/**
	 * Openclassroom Bootstrap tutorial
	 */
	public function tuto2() {
		$data = array();
		$this->load->view('bootstrap/tuto2', $data);
	}
	/**
	 * Openclassroom Bootstrap tutorial
	 */
	public function tuto3() {
		$data = array();
		$this->load->view('bootstrap/tuto3', $data);
	}
	
}
