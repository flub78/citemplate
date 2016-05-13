<?php

class Model_Metat_test1_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('meta_test1_model', 'model');
        $this->model = $this->CI->model;
    }

    public function test_image()
    {
        $image = $this->model->image('meta_test1', 'undefined_item');
        $this->assertEquals('undefined_item', $image, "image = identity for unknow element");
    }

//     public function test_image_on_unknow_table()
//     {
//     	try {
//     		$image = $this->model->image('zorglub', 'undefined_item');
//     		$this->assertTrue(false, "exception not raised");
//     	} catch (exception $e) {
//     		$this->assertTrue(true, "exception raised");
//     	}    	
//     }
    
}
