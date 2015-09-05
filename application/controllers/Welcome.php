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
		$this->home();
	}
	
	/**
	 * Project home page
	 */
	public function home() {
		if (!$this->ciauth->is_logged_in ()) {
			redirect(base_url() . 'login');
		}
		$this->load->view(translation('language') . '/home');
	}
	
	/**
	 * User login
	 */
	public function login() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('login_value', translation("login_user_label"), 'required|min_length[3]');
		$this->form_validation->set_rules('password', translation('login_password_label'), 'required');
		$data['error_msg'] = "";
		
		if ($this->form_validation->run() == FALSE) {
			# invalid input, reload the form
			$this->load->view('login', $data);				
		} else {
			# form validated
			$login_value = $this->input->post('login_value');
			$password = $this->input->post('password');
			$remember_me = $this->input->post('keep_logged_in');
			
			if (!$this->ciauth->login($login_value, $password, $remember_me)) {
				# error unknown user
				$data['error_msg'] = translation('error_user_not_found');
				$this->load->view('login', $data);
				return;
			} else {
				# logged in
				redirect(base_url());
			}				
		}
	}

	/**
	 * User logout
	 */
	public function logout() {
		$this->ciauth->logout();
		redirect(base_url());
	}
	
	/**
	 * Project about
	 */
	public function about() {
		if (!$this->ciauth->is_logged_in ()) {
			redirect(base_url() . 'login');
		}
		
		$this->load->view('about');
	}
}
