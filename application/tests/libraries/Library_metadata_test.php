<?php
class Library_Metadata_test extends TestCase {
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library('metadata');
        $this->CI->load->model('crud_model', 'model');
    }
    public function test_groups_metadata() {
        $this->assertEquals(true, true, "Metadata library loaded");

        $field_list = $this->CI->metadata->fields_list('groups');
        $this->assertEquals(3, count($field_list), "fields_list groups");

        $this->assertEquals(true, $this->CI->metadata->field_exists('groups', 'name'), "field_exist");

        $this->assertEquals(false, $this->CI->metadata->field_exists('unknown_table', 'name'), "field_exist unknown table");
        $this->assertEquals(false, $this->CI->metadata->field_exists('groups', 'unknown_field'), "field_exist unknown field");

        $this->assertEquals("text", $this->CI->metadata->field_type('groups', 'name'), " name subtype = text");
    }

    /**
     *
     * @param unknown $table
     * @param unknown $field
     * @param unknown $value
     * @param array $expected
     */
    protected function check_field($table, $field, $value, $expected = array()) {
        $df = $this->CI->metadata->display_field($table, $field, $value);
        $this->assertEquals($expected ['display_field'], $df, "display_field($table $field)");
        if ($expected ['display_field'] != $df) {
            echo "expected = " . $expected ['display_field'] . "\n";
            echo "actual = " . $df . "\n";
        }

        $fi = $this->CI->metadata->field_input($table, $field, $value);
        $this->assertContains($expected ['field_input'], $fi, "text field_input($table $field)");
        if ($expected ['field_input'] != $fi) {
            echo "expected = " . $expected ['field_input'] . "\n";
            echo "actual = " . $fi . "\n";
        }

        // Create rules
        $rules = $this->CI->metadata->rules($table, $field, 'create');
        $this->assertEquals($expected['create_rules'], $rules, "text create rules($table $field)");
        if ($expected ['create_rules'] != $rules) {
            echo "expected = " . $expected ['create_rules'] . "\n";
            echo "actual = " . $rules . "\n";
        }

        // Edit rules
        $rules = $this->CI->metadata->rules($table, $field, 'edit');
        $this->assertEquals($expected['edit_rules'], $rules, "text create rules($table $field)");
        if ($expected ['edit_rules'] != $rules) {
            echo "expected = " . $expected ['edit_rules'] . "\n";
            echo "actual = " . $rules . "\n";
        }
    }

    /**
     * <input type="text" name="username_value" id="username_value" class="form-control" value="fred" placeholder="User name" size="25" />
     * <input type="text" name="username_value" id="username_value" class="form-control text" value="fred" placeholder="User name" size="25" />
     */
    public function test_users_metadata() {
        $this->check_field('users', 'username', 'fred', array (
                'display_field' => 'fred',
                'field_input' => '<input type="text" name="username_value" id="username_value" class="form-control" value="fred" placeholder="User name" size="25" />',
                'create_rules' => 'required|max_length[100]|is_unique[users.username]|alpha_dash',
                'edit_rules' => 'required|max_length[100]|alpha_dash'
        ));

        $this->check_field('users', 'email', 'fred@free.fr', array (
                'display_field' => 'fred@free.fr',
                'field_input' => '<input type="email" name="email_value" id="email_value" class="form-control email" value="fred@free.fr" placeholder="Email address" size="25" />',
                'create_rules' => 'required|max_length[100]|valid_email',
                'edit_rules' => 'required|max_length[100]|valid_email'
        ));

        $this->check_field('users', 'active', true, array (
                'display_field' => '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
                'field_input' => '&nbsp;<input type="checkbox" name="active" value="1" checked="checked" id="active"  />',
                'create_rules' => 'max_length[1]',
                'edit_rules' => 'max_length[1]'
        ));

    }
}
