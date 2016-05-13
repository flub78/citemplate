<?php

class Model_User_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('users_model', 'model');
        $this->model = $this->CI->model;
    }

    public function test_image()
    {
        $image = $this->model->image('users', 'testadmin');
        $this->assertEquals('testadmin', $image, "image = 'testadmin'");

        $image = $this->model->image('users', 'undefined_user');
        $this->assertEquals('undefined_user', $image, "image = identity for unknow element");
    }


    public function test_selector () {
    	$selector =  $this->model->selector('users', 'id');
    	var_dump($selector);
    }

    public function test_year_selector () {
    	$selector =  $this->model->year_selector('meta_test1', 'expiration_date');
    	var_dump($selector);
    }
    
}
