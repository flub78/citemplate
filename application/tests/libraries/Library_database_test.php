<?php

class Library_Database_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('Database');
        $this->CI->load->model('crud_model', 'model');
        $this->model = $this->CI->model;
    }

    public function test_database_restore()
    {
        
        $this->database = new Database();
        $this->assertNotEquals(false, $this->database, "Database instance created");
                
        // Reset the database
        $this->database->drop_all();
        $this->CI->db->close();
        $this->CI->load->database();
        
        $tables = $this->database->show_tables();
        $this->assertEquals(0, count($tables), "no tables after reset");
        
        
        $db_file = getcwd() . '/application/tests/test_database_1.sql';
        $this->database->restore('./application/tests/test_database_1.sql', 'ci3', 'ci3', 'ci3');

        
        $tables = $this->database->show_tables();
        $this->assertEquals(true, count($tables) >= 7, "7 tables loaded from test database");
        
    }

}
