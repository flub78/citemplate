<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Constructor
	 */
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
	 * Check installation
	 *  
	 * Display errors when some are detected.
	 * 
	 * Return true when installation is OK
	 */
	protected function install_ok() {
		if (!$this->config->item('check_install')) {
			return true;
		}

		
		$errors = array();
		
		# Check that uploads is writable
		$uploads = getcwd() . '/uploads';
		if (!is_really_writable($uploads)) {
			$errors[] =  "$uploads not writable";
		}
		
		# Check that uploads/restore is writable
		$uploads .= '/restore';
		if (!is_really_writable($uploads)) {
			$errors[] =  "$uploads not writable";
		}
		
		# Check that tables are defined
		$tables = $this->db->list_tables();
		if (!$tables) {
			# Tables are not defined, install the initial database
			echo  "Installation check " . date("d/m/Y h:i:s") . br();
			echo "database not initialized"; exit;
		}
		
		if ($errors) {
			$data = array();
			$data['title'] = "Installation errors";				
			$data['message'] = '<div class="error">' . ul($errors) . '</div>';
			$this->load->view('message', $data);
			return false;
		}
		return true;
	}
	
	/**
	 * Project home page
	 */
	public function home() {
		if (!$this->install_ok()) {
			return;
		}
		
		if (!$this->ciauth->is_logged_in ()) {
			redirect(base_url() . 'login');
		}
		$this->load->view(translation('language') . '/home');
	}
	
	/**
	 * User login
	 */
	public function login() {
		// $this->load->library('form_validation');
		
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
		$this->load->view('about');
	}
}
