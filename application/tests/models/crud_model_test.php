<?php

class Crud_model_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('crud_model', 'model');
        $this->model = $this->CI->model;
    }

    public function test_get_category_list()
    {
        $list = $this->model->select_all('ciauth_user_privileges');
        $count =  $this->model->count('ciauth_user_privileges');
        $this->assertEquals(true, count($list) >= $count, "Correct number of elements");
    }

}
