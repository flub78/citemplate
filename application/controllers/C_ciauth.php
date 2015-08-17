<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Name: ciauth
 * File: ciauth.php
 * Path: controllers/ciauth.php
 * Author: Glen Barnhardt
 * Company: Barnhardt Enterprises, Inc.
 * Email: glen@barnhardtenterprises.com
 * SiteURL: http://www.ciauth.com
 * GitHub URL: https://github.com/barnent1/ciauth.git
 *
 * Copyright 2015 Barnhardt Enterprises, Inc.
 *
 * Licensed under GNU GPL v3.0 (See LICENSE) http://www.gnu.org/copyleft/gpl.html
 * 
 * Description: CodeIgniter Login Authorization Library. Created specifically
 * for PHP 5.5 and Codeigniter 3.0+
 * 
 * Requirements: PHP 5.5 or later and Codeigniter 3.0+
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class C_ciauth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (! defined ('SITE_PATH')) {
        	define('SITE_PATH', $this->config->item('base_url'));
        }
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('ciauth', 'form_validation'));
    }

    public function index() {


        /*
         * We can set the meta description, meta author, and title of each
         * page using the varibles. This is to give SEO value to our pages.
         */

        $meta_description = 'Ciauth - Authorization, Navigation, and Template libraries for CodeIgniter.';
        $meta_author = 'Glen Barnhardt, CEO Barnhardt Enterprises, Inc.';
        $data = array();
        $data['title'] = "CIAUTH Demo Template";
        $data['meta_description'] = $meta_description;
        $data['meta_author'] = $meta_author;

        /*
         * Build the navigation
         * We grab values from the database for our navigation. These can
         * be changed in our admin interface under navigation.
         */

        $nav = new ciauth_nav();
        $nav->db_fields = array('id' => 'id', 'parent' => 'parent');

        $nav_elements = $this->M_ciauth_nav->get_menus();
        $nav_menu = $nav->walk($nav_elements, 10);
  
        if ($this->ciauth->is_logged_in()) {
        	$data['nav_menu'] = $nav_menu;
        } else {
        	$data['nav_menu'] = "";
        }

        /*
         * load our V_template and the ciauth basic 
         */

        $this->ciauth_template->load('V_template', 'V_ciauth_basic', $data);
    }

    public function about() {
        /*
         * We can set the meta description, meta author, and title of each
         * page using the varibles. This is to give SEO value to our pages.
         */

        $meta_description = 'Ciauth - Authorization, Navigation, and Template libraries for CodeIgniter.';
        $meta_author = 'Glen Barnhardt, CEO Barnhardt Enterprises, Inc.';
        $data = array();
        $data['title'] = "CIAUTH About";
        $data['meta_description'] = $meta_description;
        $data['meta_author'] = $meta_author;

        /*
         * Build the navigation
         * We grab values from the database for our navigation. These can
         * be changed in our admin interface under navigation.
         */

        $nav = new ciauth_nav();
        $nav->db_fields = array('id' => 'id', 'parent' => 'parent');

        $nav_elements = $this->M_ciauth_nav->get_menus();
        $nav_menu = $nav->walk($nav_elements, 10);

        if ($this->ciauth->is_logged_in()) {
        	$data['nav_menu'] = $nav_menu;
        } else {
        	$data['nav_menu'] = "";
        }
        
        /*
         * load our V_template and the ciauth basic 
         */

        $this->ciauth_template->load('V_template', 'V_ciauth_about', $data);
    }

    /*
     * Function: login
     * Creates the login form to display
     */

    public function login() {
        $data = array();
        $data['login_form'] = $this->ciauth->get_login_form();

        /*
         * We can set the meta description, meta author, and title of each
         * page using the varibles. This is to give SEO value to our pages.
         */

        $meta_description = 'Ciauth - Authorization, Navigation, and Template libraries for CodeIgniter.';
        $meta_author = 'Glen Barnhardt, CEO Barnhardt Enterprises, Inc.';
        
        $data['title'] = "Ciauth Login";
        $data['meta_description'] = $meta_description;
        $data['meta_author'] = $meta_author;

        /*
         * Build the navigation
         * We grab values from the database for our navigation. These can
         * be changed in our admin interface under navigation.
         */

        $nav = new ciauth_nav();
        $nav->db_fields = array('id' => 'id', 'parent' => 'parent');

        $nav_elements = $this->M_ciauth_nav->get_menus();
        $nav_menu = $nav->walk($nav_elements, 10);

        $data['nav_menu'] = $nav_menu;
        $data['nav_menu'] = ""; # menu not enabled on login page
        
        $this->form_validation->set_rules('login_value', 'Username or Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));

        if ($this->form_validation->run() == FALSE) {
            /*
             * load our V_template and the ciauth/V_login 
             */
            
            $this->ciauth_template->load('V_template', 'ciauth/V_login', $data);
        } else {
            $login_value = $this->input->post('login_value');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('keep_logged_in');
            if (!$this->ciauth->login($login_value, $password, $remember_me)) {
                $data['ciauth_error'] = "The username/email or password was not found";
                /*
                 * load our V_template and the ciauth basic 
                 */

                $this->ciauth_template->load('V_template', 'ciauth/V_login', $data);
            } else {
                redirect(SITE_PATH);
            }
        }
    }
    
    /*
     * Function: logout
     * Logs the current user out and removes the session.
     */
    
    public function logout(){
        $this->ciauth->logout();
        redirect(SITE_PATH);
    }

    /*
     * Function: register
     * Creates the registration form to display
     */

    public function register() {
        $data = array();
        $registration_form = $this->ciauth->get_registration_form();

        /*
         * We can set the meta description, meta author, and title of each
         * page using the varibles. This is to give SEO value to our pages.
         */

        $meta_description = 'Ciauth - Authorization, Navigation, and Template libraries for CodeIgniter.';
        $meta_author = 'Glen Barnhardt, CEO Barnhardt Enterprises, Inc.';
        $data = array();
        $data['title'] = "Ciauth Register";
        $data['meta_description'] = $meta_description;
        $data['meta_author'] = $meta_author;

        /*
         * Build the navigation
         * We grab values from the database for our navigation. These can
         * be changed in our admin interface under navigation.
         */

        $nav = new ciauth_nav();
        $nav->db_fields = array('id' => 'id', 'parent' => 'parent');

        $nav_elements = $this->M_ciauth_nav->get_menus();
        $nav_menu = $nav->walk($nav_elements, 10);
        $nav_menu = "";

        $data['nav_menu'] = $nav_menu;
        $data['registration_form'] = $registration_form;

        $this->form_validation->set_rules('email_value', 'Email', 'required');
        $this->form_validation->set_rules('username_value', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_recaptcha');


        if ($this->form_validation->run() == FALSE) {
            /*
             * load our V_template and the ciauth/V_login 
             */

            $this->ciauth_template->load('V_template', 'ciauth/V_registration', $data);
        } else {
            $query_data = array();
            $query_data["email"] = $this->input->post('email_value');
            $query_data["username"] = $this->input->post('username_value');
            $query_data["password"] = $this->input->post('password');

            if (!$this->ciauth->register($query_data)) {
                $data['ciauth_error'] = "There was an error with your registration";
                /*
                 * load our V_template and the ciauth basic 
                 */

                $this->ciauth_template->load('V_template', 'ciauth/V_registration', $data);
            } else {
                redirect(SITE_PATH . "/login");
            }
        }
    }

    public function recaptcha($str = '') {
        $google_url = "https://www.google.com/recaptcha/api/siteverify";
        $secret = $this->config->item('recaptcha_secret');
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = $google_url . "?secret=" . $secret . "&response=" . $str . "&remoteip=" . $ip;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $res = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($res, true);
        //reCaptcha success check
        if ($res['success']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('recaptcha', 'The CAPTCHA field is telling me that you are a robot. Would you like to give it another try?');
            return FALSE;
        }
    }

    /*
     * Function: forgot_password
     * Send a email to the users email so that they can reset there password
     */

    function forgot_password() {
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->model('M_ciauth');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback_check_email');
        if ($this->form_validation->run() == FALSE) {
            $meta_description = "CIAUTH | Forgot Password";
            $meta_author = "Glen Barnhardt | Barnhardt Enterprises, Inc.";
            $data = array();
            $data['title'] = "CIAUTH | Forgot Password";
            $data['meta_description'] = $meta_description;
            $data['meta_author'] = $meta_author;

            /*
             * Build the navigation
             */
            $nav = new ciauth_nav();
            $nav->db_fields = array('id' => 'id', 'parent' => 'parent');

            $nav_elements = $this->M_ciauth_nav->get_menus();
            $nav_menu = $nav->walk($nav_elements, 10);

            $data['error'] = validation_errors();
            $data['nav_menu'] = $nav_menu;
            $this->template->load('V_template', 'V_ds_forgot_password', $data);
        } else {
            $email = $this->input->post("email");

            //send an email
            $this->load->library('email');
            $token = sha1(uniqid($email, true));
            $reset_link = "/password-reset/" . $token;


            $this->email->set_newline("\r\n");
            $this->email->from('noreply@ciauth.com', 'CIAUTH');
            $this->email->to($email);
            $this->email->subject('CIAUTH Password Reset');
            $message = "Please click on the link below to reset your Password. If you did not initiate this reset please ignore this email and your password will remain the same.";
            $message .= "\n\n" . $reset_link;
            $message .="\n\n" . "Thank you very much";
            $this->email->message($message);

            if ($this->email->send()) {
                $this->M_ciauth->store_token($email, $token);
                $meta_description = "CIAUTH | Forgot Passwrod";
                $meta_author = "Glen Barnhardt | Barnhardt Enterprises, Inc.";
                $data = array();
                $data['title'] = "CIAUTH | Forgot Password";
                $data['meta_description'] = $meta_description;
                $data['meta_author'] = $meta_author;

                /*
                 * Build the navigation
                 */
                $nav = new ciauth_nav();
                $nav->db_fields = array('id' => 'id', 'parent' => 'parent');

                $nav_elements = $this->M_ciauth_nav->get_menus();
                $nav_menu = $nav->walk($nav_elements, 10);

                $data['error'] = validation_errors();
                $data['nav_menu'] = $nav_menu;
                $data['content'] = "<h1>Please Check Your Email</h1>";
                $this->template->load('V_template', 'V_ds_display_message', $data);
            } else {
                show_error($this->email->print_debugger());
            }
        }
    }

    /*
     * Function: check_email
     * Varifies that the email exists.
     */

    function check_email($email) {
        $this->load->model("M_ciauth");
        if (!$this->M_ciauth->check_email($email)) {
            $this->form_validation->set_message('check_email', 'The %s does not exists in our database');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * Function: check_email
     * Varifies that the email exists.
     */

    function password_reset($token) {
        $this->load->model("M_ciauth");
        if ($tdata = $this->M_ciauth->get_token($token)) {

            $meta_description = "CIAUTH | Forgot Passwrod";
            $meta_author = "Glen Barnhardt | Barnhardt Enterprises, Inc.";
            $data = array();
            $data['title'] = "CIAUTH | Forgot Password";
            $data['meta_description'] = $meta_description;
            $data['meta_author'] = $meta_author;

            /*
             * Build the navigation
             */
            $nav = new ciauth_nav();
            $nav->db_fields = array('id' => 'id', 'parent' => 'parent');

            $nav_elements = $this->M_ciauth_nav->get_menus();
            $nav_menu = $nav->walk($nav_elements, 10);

            $data['error'] = validation_errors();
            $data['nav_menu'] = $nav_menu;
            $token_time = $tdata->tstamp;
            $token_timeout = time() - (60 * 60 * 24);
            if ($token_timeout < $token_time) {
                $this->M_ciauth->temp_login($tdata);
                $data['content'] = "<h1>You have been temporarily logged in please go to Account and change your password.</h1>";
            } else {
                $data['content'] = "<h1>Your token has expired please start the forgot password process again.</h1>";
            }
        } else {
            $data['content'] = "<h1>This URL link appears to be invalid.</h1>";
        }

        $this->template->load('V_template', 'V_ds_display_message', $data);
    }

    /*
     * Function: process_login_form_ajax
     * Validates the data passed from the ajax based login form.
     * Parameters: login_value, password, keep_logged_in
     */

    public function process_login_form_ajax() {
        $login_value = $this->input->post('login_value');
        $password = $this->input->post('password');
        $keep_logged_in = $this->input->post('keep_logged_in');

        if ($keep_logged_in == true) {
            $rememberme = 'Y';
        } else {
            $rememberme = 'N';
        }

        $this->form_validation->set_rules('login_value', 'Username or Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));

        if ($this->form_validation->run() == FALSE) {
            $errors = array("status" => "false", "message" => "You must enter a login name and password.");
            $return = json_encode($errors);
        } else {
            if (!$this->ciauth->login($login_value, $password, $rememberme)) {
                $errors = array("status" => "false", "message" => "The username/email and password combination failed authentication.");
                $return = json_encode($errors);
            } else {
                $success = array("status" => "true", "message" => "Success");
                $return = json_encode($success);
            }
        }
        echo $return;
    }

    public function registration() {
        $data = array();
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('address2', 'Apt, Suite, PO', '');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('conf_password', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['registration_form'] = $this->ciauth->get_registration_form();
            $this->load->view('ciauth/V_registration', $data);
        } else {
            $query_data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zipcode' => $this->input->post('zipcode'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );

            if (!$this->ciauth->register($query_data)) {
                $data['ciauth_error'] = "The username/email or password was not found";
                $this->load->view('ciauth/V_registration', $data);
            } else {
                redirect(SITE_PATH . "/login");
            }
        }
    }

}
