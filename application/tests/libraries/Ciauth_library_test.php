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
        
        $this->CI->ciauth->login("flub78", "belobelo", false);
        
        $this->assertEquals(true, $this->CI->ciauth->is_logged_in(), "Logged in");
        
        $this->CI->ciauth->logout();

        $this->assertEquals(false, $this->CI->ciauth->is_logged_in(), "Not logged in");
        
        $name = get_class($this);
    }

}
