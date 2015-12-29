<?php

class Metadata_library_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('metadata');
        $this->CI->load->model('crud_model', 'model');
    }

    public function test_privileges_metadata()
    {
        $this->assertEquals(true, true, "Metadata library loaded");

        $field_list = $this->CI->metadata->fields_list('groups');
        $this->assertEquals(3, count($field_list), "fields_list groups");

        $this->assertEquals(true, $this->CI->metadata->field_exists('groups', 'name'), "field_exist");

        $this->assertEquals(false, $this->CI->metadata->field_exists('unknown_table', 'privilyege_name'), "field_exist unknown table");
        $this->assertEquals(false, $this->CI->metadata->field_exists('groups', 'unknown_field'), "field_exist unknown field");

        $this->assertEquals("text", $this->CI->metadata->field_type('groups', 'name'), " name subtype = text");

    }

}
