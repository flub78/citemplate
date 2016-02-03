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

		$this->load->library('database');

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
			$this->logger->info('No tables in database, trigger automatic installation');

			# Removed, I'll try to do all database structure changes though migrations
			# I keep thecode just in case
// 			$sqlfile = getcwd() . "/install/structure.sql";
// 			$sql = file_get_contents($sqlfile);
// 			$res = $this->database->sql($sql);
// 			$this->logger->info("sql installation script result = " . var_export($res, true));

			// check migration especially ion_auth tables
			$this->check_migration();

			// Create default user
			$this->logger->info("Create default user");

			$username = 'admin';
			$password = 'admin';
			$email = 'admin@gmail.com';
			$additional_data = array(
			        'first_name' => 'Admin',
			        'last_name' => 'Admin',
			);
			$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

			$userid = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

			for ($i = 0; $i < 100; $i++) {
                $additional_data = array (
                        'first_name' => $username . "_firstname_$i",
                        'last_name' => $username . "_name_$i"
                );
                $username = "user_$i";
                $userid = $this->ion_auth->register($username, $username, $username . "@gmail.com",
                        $additional_data, $group);
            }
			if ($userid) {
			    $this->logger->info("Default user $userid created");
			} else {
			    $this->logger->error("Error creating default user $username");
			}
			$this->logger->info("Default user created");


		} else {
		    // Check migration
		    $res = $this->check_migration();
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
	 * Run a migration if required.
	 *
	 * There is a bug in the CodeIgniter migration library and the target migration
	 * is done over and over even when the value in the configuration file
	 * and the database are equal.
	 */
	protected function check_migration() {
		$this->load->library('migration');
		$this->config->load('migration');

		# look for the current migration level in database
		$query = $this->db->query('SELECT version FROM migrations LIMIT 1');
		$row = $query->row();
		$db_version = $row->version;
		# echo "DB version = " . $row->version;

		# Look for the target migration in configuration file
	    $program_level = $this->config->item('migration_version');
        # echo "program= $program_level";

        if ($program_level == $db_version) {
            # echo "No migration needed";
            return;
        }

        # Execute migrations
        $res = $this->migration->current();

        if ($res) {
            $this->logger->info("Migration to $res, config['migration_version'] = $program_level");
        } else {
            $this->logger->info("Pas de migration, config['migration_version'] = $program_level");
        }
	}

	/**
	 * Project home page
	 */
	public function home() {
		if (!$this->install_ok()) {
			return;
		}

		if (!$this->ion_auth->logged_in ()) {
			redirect(base_url() . 'auth/login');
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

			if (!$this->ion_auth->login($login_value, $password, $remember_me)) {
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
		$this->ion_auth->logout();
		redirect(base_url());
	}

	/**
	 * Project about
	 */
	public function about() {
		$this->load->view('about');
	}
}
