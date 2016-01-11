<?php
/**
 *    Project {$PROJECT}
 *    Copyright (C) 2015 {$AUTHOR}
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource Logger.php
 * @package libraries
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Metadata types provide specific methods to display or input this kind of data.
 * Each type register itself to the Type_Manager. On demand the type manager
 * the correct type of object in each context.
 *
 *  - display_field : to display a database field into a table
 *  - field_input : to generate an input area for the field in forms
 *  - rules : to validate the fiel after input.
 *
 *  display_field is in charge of formating the database data and make it suitable
 *  for display taking into account languages and localisation.
 *
 *  The rules should include filters in charge of the reverse operation, for example
 *  transforming a local date format into a mysql date format.
 *
 * @author frederic
 *
 */
class Metadata_type {

	protected $CI;

    var $name = "";
//     static $registered = array ();

//     /**
//      * Children of Metadata_type must register so one may call them by name
//      *
//      * @param unknown $name
//      * @param unknown $object
//      */
//     protected static function register($name, $object) {
//         self::$registered [$name] = $object;
//     }

//     /*
//      * Return the instance object in charge of managing one type
//      */
//     public static function instance_of($name) {
//         if (!isset(self::$registered [$name])) {
//             $name = 'default';
//         }
//         return self::$registered [$name];
//     }

    /**
     * Constructor
     *
     * @param array $attrs
     */
    function __construct($attrs = array()) {
        // register itself to the type manager
//         Metadata_type::register('default', $this);
        $this->CI = & get_instance();
    }

    /**
     * Transform a field from the database into something suitable for display
     *
     * So it mainly takes formating and languages into account.
     *
     * @param unknown $table
     * @param unknown $field
     * @param unknown $value
     * @param
     *            $format
     */
    function display_field($table, $field, $value, $format = "html") {
        if (! $value) {
            // to support null fields
            return '';
        }
        // by default no formatting
        return $value;
    }

    /**
     * Generate a form field input
     *
     * @param unknown $table
     * @param unknown $field
     * @param unknown $value
     * @param
     *            $format
     */
    function field_input($table, $field, $value = '', $attrs = array()) {

        $CI = & get_instance ();

        //echo "field_input table=$table, field=$field, value=$value\n" . br();

        $type = $CI->metadata->field_type($table, $field);
        $name = $CI->metadata->field_name($table, $field);
        $id = $CI->metadata->field_id($table, $field);
        $db_type = $CI->metadata->field_db_type($table, $field);
        $size = $CI->metadata->field_size($table, $field);
        $placeholder = $CI->metadata->field_placeholder($table, $field);

        $info = "field_input($table, $field) ";
        $info .= "type=$type, size=$size, placeholder=$placeholder, value=$value";
        $CI->metadata->log($info);

        // TODO: use form_input
        $input = '<input';
        if ($type) {
            $input .= " type=\"$type\"";
        }
        if ($name) {
            $input .= " name=\"$name\"";
        }
        if ($id) {
            $input .= " id=\"$id\"";
        }

        $class = 'form-control';
        if ($db_type == 'date') {
            $class .= ' date';
        }
        if ($db_type == 'time') {
            $class .= ' time';
        }
        if ($db_type == 'datetime') {
            $class .= ' datetime';
        }
        if ($type) {
            $class .= ' ' . $type;
        }
        if (array_key_exists('class', $attrs)) {
            $class = $attrs['class'];
        }

        $input .= " class=\"$class\"";
        $input .= " value=\"$value\"";
        if ($placeholder) {
            $input .= " placeholder=\"$placeholder\"";
        }
        if ($size) {
            $input .= " size=\"$size\"";
        }

        $input .= ' />';
        return $input;
    }

    /**
     * Return the validation rules deduced from metadata
     *
     * rules is invoked in form validation method, metadata must be loaded on demand
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @param unknown_type $action
     *            'user_id' =>
     *            object(stdClass)[34]
     *            public 'name' => string 'user_id' (length=7)
     *            public 'type' => string 'int' (length=3)
     *            public 'default' => null
     *            public 'max_length' => null
     *            public 'primary_key' => int 1
     *            public 'auto_increment' => int 1
     *            public 'allow_null' => boolean false
     */
    function rules($table, $field, $action) {
        $this->CI = & get_instance();
        $this->CI->load->library("Metadata");

        $rule = "";

        // If the rules for this field are forced
        $absolute_rules = $this->CI->metadata->absolute_rules($table, $field, $action);
        if ($absolute_rules) {
            // echo "absolute_rules($table, $field, $action) = $absolute_rules";
            return $absolute_rules;
        }

        // Rules deduced from the database info
        if (!$this->CI->metadata->allow_null($table, $field)) {
            $this->add_rule($rule, 'required');
        }

        $max_length = $this->CI->metadata->max_length($table, $field);
        if ($max_length) {
            $rl = 'max_length[' .  $max_length . ']';
            $this->add_rule($rule, $rl);
        }


        // add user defined rules
        $additional_rules = $this->CI->metadata->additional_rules($table, $field, $action);
        if ($additional_rules) {
            $this->add_rule($rule, $additional_rules);
        }

        // remove is_unique in edit mode
        if ($action != 'create') {
            $this->remove_rule($rule, 'is_unique');
        }

        $this->CI->metadata->log("rules($table,$field) = " . $rule);
        // return '';
        return $rule;
    }

    /**
     * Add a rule to the rules string
     *
     * @param unknown $rules
     * @param unknown $new_rule
     */
    protected function add_rule(&$rules, $new_rule) {
        if ($rules) {
            $rules .= '|';
        }
        $rules .= $new_rule;
    }

    /**
     * Remove a rule from the rules string
     *
     * @param unknown $rules
     * @param unknown $delete_rule
     */
    protected function remove_rule(&$rules, $delete_rule) {

        // echo "removing $delete_rule from $rules\n";
        $splitted = preg_split('/\|/', $rules);
        $rls = "";
        foreach ( $splitted as $rl ) {
            if (! preg_match("/$delete_rule/", $rl)) {
                $this->add_rule($rls, $rl);
            }
        }
        $rules = $rls;
    }

}

