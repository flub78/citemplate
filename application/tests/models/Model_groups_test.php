<?php

class Model_Groups_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('groups_model', 'model');
        $this->model = $this->CI->model;
    }

    public function test_image()
    {
        $image = $this->model->image('groups', 'admin');
        $this->assertEquals('admin', $image, "image = 'admin'");

        $image = $this->model->image('groups', 'undefined_group');
        $this->assertEquals('undefined_group', $image, "image = identity for unknow element");
    }

    
}
