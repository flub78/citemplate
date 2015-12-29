<?php

class Library_auth_test extends TestCase
{

    public function setUp()
    {
        $this->resetInstance();
//         $this->CI->load->library('Ion_auth');
//         $this->obj = $this->CI->ion_auth;
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
        $logged_in = $this->CI->ion_auth->logged_in();
//     	$this->assertEquals(false, $logged_in, "Not logged in after logout: logged_in=" . var_export($logged_in, true));

    	$this->CI->ion_auth->login("admin", "admin", true);
    	$this->assertEquals(true, $this->CI->ion_auth->logged_in(), "Logged in");
    	$this->assertEquals(true, $this->CI->ion_auth->is_admin(), "Administrators are admin");

//     	$this->CI->ion_auth->logout();
    	$res = $this->CI->ion_auth->logged_in();
    	var_dump($res);
//     	$this->assertEquals(false, $this->CI->ion_auth->logged_in(), "Not logged in");

    	$name = get_class($this);
    }


}
