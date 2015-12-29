<?php

class TestCase extends CIPHPUnitTestCase
{
	function __construct() {
	    ob_start();
	    $this->CI = & get_instance();
		$this->CI->load->library('Ion_auth');

	    parent :: __construct();

	    if ($this->CI->ion_auth->logged_in()) {
	        $this->CI->ion_auth->logout();
	    }
	    $this->CI->ion_auth->login('admin', 'admin', true);

		if (!isset($_SESSION)) {
		    echo "starting session";
			session_start();
		}
	}

	function __destruct() {
	   if ($this->CI->ion_auth->logged_in()) {
// 		  $this->CI->ion_auth->logout();
	    }
	}

}
