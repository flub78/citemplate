<?php

class Metadata_library_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->library('metadata');
        $this->CI->load->model('crud_model', 'model');
    }

    public function test_groups_metadata()
    {
        $this->assertEquals(true, true, "Metadata library loaded");

        $field_list = $this->CI->metadata->fields_list('groups');
        $this->assertEquals(3, count($field_list), "fields_list groups");

        $this->assertEquals(true, $this->CI->metadata->field_exists('groups', 'name'), "field_exist");

        $this->assertEquals(false, $this->CI->metadata->field_exists('unknown_table', 'name'), "field_exist unknown table");
        $this->assertEquals(false, $this->CI->metadata->field_exists('groups', 'unknown_field'), "field_exist unknown field");

        $this->assertEquals("text", $this->CI->metadata->field_type('groups', 'name'), " name subtype = text");
    }

    public function test_users_metadata() {
        $value = 'fred';
        $df = $this->CI->metadata->display_field('users', 'username', $value);
        $this->assertEquals($value, $df, "text display_field");

        $fi = $this->CI->metadata->field_input('users', 'username', $value);
        $res = '<input type="text" name="username_value" id="username_value" class="form-control text" value="fred" placeholder="User name" size="25" />';
        $this->assertEquals($res, $fi, "text field_input");

        // Create rules
        $rules = $this->CI->metadata->rules('users', 'username', 'create');
        $res = 'required|max_length[100]|is_unique[users.username]|alpha_dash';
        $this->assertEquals($res, $rules, "text create rules");

        // Edit rules
        $rules = $this->CI->metadata->rules('users', 'username', 'edit');
        echo $rules;
    }
}
