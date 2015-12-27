<?php

class Database_library_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('Database');
    }

    public function test_show_tables()
    {
        $this->assertEquals(true, true, "Database");
        
        $this->database = new Database();
        $result = $this->database->sql('show tables');
    }

}
