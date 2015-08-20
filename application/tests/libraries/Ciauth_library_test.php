<?php

class Ciauth_library_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('ciauth');
        $this->obj = $this->CI->ciauth;
    }

    public function test_lib()
    {
        $this->assertEquals(false, $this->CI->ciauth->is_logged_in(), "Not logged in");       
        
        $this->CI->ciauth->login("testuser", "testuser", false);        
        $this->assertEquals(true, $this->CI->ciauth->is_logged_in(), "Logged in");
        $this->assertEquals(false, $this->CI->ciauth->is_admin(), "Regular users are not admin");
        
        $this->CI->ciauth->logout();
        $this->assertEquals(false, $this->CI->ciauth->is_logged_in(), "Not logged in");
        
        $name = get_class($this);
    }

    public function test_admin()
    {
    	$this->assertEquals(false, $this->CI->ciauth->is_logged_in(), "Not logged in");
    
    	$this->CI->ciauth->login("testadmin", "testadmin", true);   
    	$this->assertEquals(true, $this->CI->ciauth->is_logged_in(), "Logged in");
    	$this->assertEquals(true, $this->CI->ciauth->is_admin(), "Administrators are admin");
    
    	$this->CI->ciauth->logout();
    	$this->assertEquals(false, $this->CI->ciauth->is_logged_in(), "Not logged in");
    
    	$name = get_class($this);
    }

//     public function test_encrypt()
//     {
//     	$key = "DEADBEEFDEADBEEFDEADBEEFDEADBEEFDEADBEEFDEADBEEFDEADBEEFDEADBEEF";
//     	$txt = "Hello world";
//     	$ciphered = $this->CI->encrypt($txt, $key);
//     	$this->assertNotEquals($txt, $ciphered, "Text modified by encryption");
//     }

    public function test_get_registration_form() {
		$this->CI->load->helper('form');
    	$form = $this->CI->ciauth->get_registration_form();
    	$this->assertNotEquals("", $form, "Registration form");
    }
}
