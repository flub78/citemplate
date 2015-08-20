<?php

class Ciauth_datatables_library_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('ciauth_datatables');
        $this->testlib = $this->CI->ciauth_datatables;
    }

    public function test_fatal()
    {
    	$this->assertEquals(true, isset($this->testlib), "Datatable library loaded");
    }

}
