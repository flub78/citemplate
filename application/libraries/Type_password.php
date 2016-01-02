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
 */
class Type_password extends Metadata_type {
    var $name = "";


    /**
     * Constructor
     *
     * @param array $attrs
     */
    function __construct($attrs = array()) {
        $name = 'password';
		// register itself to the type manager
		Metadata_type::register($name, $this);
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
        return '';
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
//     function field_input($table, $field, $value = '', $attrs = array()) {
//         return parent::field_input($table, $field, $value, $attrs);
//     }

    /**
     * Return the validation rules deduced from metadata
     *
     * rules is invoked in form validation method, metadata must be loaded on demand
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @param unknown_type $action
     *
     *   'user_id' =>
     object(stdClass)[34]
     public 'name' => string 'user_id' (length=7)
     public 'type' => string 'int' (length=3)
     public 'default' => null
     public 'max_length' => null
     public 'primary_key' => int 1
     public 'auto_increment' => int 1
     public 'allow_null' => boolean false
     */
    function rules($table, $field, $action) {
        return parent::rules($table, $field, $action);
    }
}

