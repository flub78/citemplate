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



}
