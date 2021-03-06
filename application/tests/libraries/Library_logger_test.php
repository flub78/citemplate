<?php

class Library_Logger_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('logger');
    }

    public function test_log_at_different_levels()
    {
        $this->assertEquals(true, true, "Logger");
        
        $name = get_class($this);
        $this->logger = new Logger($name);
        
        $this->logger->info("INFO level information");
        $this->logger->error("ERROR level information");
        $this->logger->debug("DEBUG level information");
    }

}
