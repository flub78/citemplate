<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->view('welcome_message');
	}
	
	/**
	 * Project home page
	 */
	public function home() {
		echo "Welcome home";
		$this->load->view('about');
	}
	
	/**
	 * User login
	 */
	public function login() {
		echo "Welcome login";
		$this->load->view('about');
	}
	
	/**
	 * Project about
	 */
	public function about() {
		$this->load->view('about');
	}
}
