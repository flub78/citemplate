<?php

class Metadata_model_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('metadata_model', 'metadata');
        $this->model = $this->CI->metadata;
    }

    public function test_get_category_list()
    {
        $expected = array("application/tests", "livres");
        $list = $this->model->tables();
        $this->assertEquals(10, count($list), "Correct number of tables");
    }

}
