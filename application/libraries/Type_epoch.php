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
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Metadata types provide specific methods to display or input this kind of data.
 * Each type register itself to the Type_Manager. On demand the type manager
 * the correct type of object in each context.
 *
 * @author frederic
 *
 * Mysql handels several time related types:
 *    DATE: date without time part
 *    DATETIME: dates with time part, range '1000-01-01 00:00:00' to '999-12-31 23:59:59'
 *    TIMESTAMP: dates with time part, Unix range '1970-01-01 00:00:01' to '2038-01-19 03:14:07' UTC
 *    TIME: time of the day or result of DATETIME difference.
 *
 *    TIMESTAMPs are stored in UTC but converted to local when retrieved.
 */
class Type_epoch extends Metadata_type {
    var $name = "";


    /**
     * Constructor
     *
     * @param array $attrs
     */
    function __construct($attrs = array()) {
        $this->name = 'epoch';
    }

    /**
     * Transform a field from the database into something suitable for display
     *
     * So it mainly takes formating and languages into account.
     *
     * @param unknown $table
     * @param unknown $field
     * @param unknown $value
     * @param $format
     */
    function display_field($table, $field, $value, $format = "html") {
        if (! $value) {
            // to support null fields
            return '';
        }
        $this->CI = & get_instance();
        $format = "m/d/Y h:i:s";
        $translated = $this->CI->lang->line('format_epoch');
        if ($translated) {
            $format = $translated;
        }
        return date($format, $value);
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
        $attrs['class'] = "form-control epoch";
        return parent::field_input($table, $field, $value, $attrs);
    }

    /**
     * Return the validation rules deduced from metadata
     *
     * rules is invoked in form validation method, metadata must be loaded on demand
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @param unknown_type $action
     *
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

//         $max_length = $this->CI->metadata->max_length($table, $field);
//         if ($max_length) {
//             $rl = 'max_length[' .  $max_length . ']';
//             $this->add_rule($rule, $rl);
//         }

        // add user defined rules
        $additional_rules = $this->CI->metadata->additional_rules($table, $field, $action);
        if ($additional_rules) {
            $this->add_rule($rule, $additional_rules);
        }

        // remove is_unique in edit mode
        if ($action != 'create') {
            $this->remove_rule($rule, 'is_unique');
        }

        $this->add_rule($rule, "callback_valid_" . $this->name);

        $this->CI->metadata->log("rules($table,$field) = " . $rule);

        return $rule;
    }
}

