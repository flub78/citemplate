<?php

class Unzip_library_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('Unzip');
    }

    public function test_basic_unzip()
    {

        $this->unzip = new Unzip();
        $this->unzip->set_error('error');
        $expected = '<p class="error">error</p>';
        $result = $this->unzip->error_string("<p class=\"error\">");
        $this->assertEquals($expected, $result, "error_string");

        $this->unzip->set_debug('debug');
        $result = $this->unzip->debug_string();
        $expected = '<p>debug</p>';
        $this->assertEquals($expected, $result, "debug_string");
        
        $pwd = getcwd();
        $zipfile = $pwd . '/application/tests/backup_2015_10_26.zip';
        $extracted = $pwd . '/application/tests/backup_2015_10_26.sql';
        
        // echo $zipfile;
        $this->assertEquals(true, file_exists($zipfile), "zipfile exists");
        $this->assertEquals(false, file_exists($extracted), "extracted does not exists");
        
        $this->unzip->extract($zipfile);
        $this->assertEquals(true, file_exists($extracted), "extracted exists");
        unlink($extracted);
        $this->assertEquals(false, file_exists($extracted), "extracted deleted");
        $this->unzip->close();
        
    }

}
