<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testtest extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
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
		echo "test application";
	}



	/**
	 * Project about
	 */
	public function about() {
		$this->load->view('gvv/about');
	}
}
