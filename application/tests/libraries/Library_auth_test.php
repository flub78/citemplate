<?php

class Library_auth_test extends TestCase
{
	function __construct() {
		if (!isset($_SESSION)) {
			session_start();
		}
	    parent :: __construct();
	}

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('Ion_auth');
        $this->obj = $this->CI->ion_auth;
    }

//     public function test_lib()
//     {
//         $this->CI->ciauth->logout();
//     	$this->assertEquals(false, $this->CI->ciauth->is_logged_in(), "Not logged in");

//         $this->CI->ciauth->login("testuser", "testuser", false);
//         $this->assertEquals(true, $this->CI->ciauth->is_logged_in(), "Logged in");
//         $this->assertEquals(false, $this->CI->ciauth->is_admin(), "Regular users are not admin");

//         $this->CI->ciauth->logout();
//         $this->assertEquals(false, $this->CI->ciauth->is_logged_in(), "Not logged in");

//         $name = get_class($this);
//     }

    public function test_admin()
    {
        $this->CI->ion_auth->logout();
    	$this->assertEquals(false, $this->CI->ion_auth->logged_in(), "Not logged in");

    	$this->CI->ion_auth->login("admin@gmail.com", "admin", true);
    	$this->assertEquals(true, $this->CI->ion_auth->logged_in(), "Logged in");
    	$this->assertEquals(true, $this->CI->ion_auth->is_admin(), "Administrators are admin");

    	$this->CI->ion_auth->logout();
    	$res = $this->CI->ion_auth->logged_in();
    	var_dump($res);
//     	$this->assertEquals(false, $this->CI->ion_auth->logged_in(), "Not logged in");

    	$name = get_class($this);
    }


}
