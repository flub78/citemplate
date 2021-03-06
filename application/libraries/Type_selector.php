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
 * Each type is registered to the Type_Manager. On demand the type manager
 * the correct type of object in each context.
 *
 * @author frederic
 *
 */
class Type_selector extends Metadata_type {
    var $name = "";


    /**
     * Constructor
     *
     * @param array $attrs
     */
    function __construct($attrs = array()) {
        $name = 'selector';
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
        // in this case the value is the table primary key
        $CI = & get_instance ();

        // The correct model must be loaded to get the correct image function
        $model = $CI->metadata->table_model($table);
        $CI->load->model($model, 'model');

        return $CI->model->image($table, $value);
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

        // The correct model must be loaded to get the correct image function
        $model = $CI->metadata->table_model($attrs['table']);
        $CI->load->model($model, 'attribute');

        if (isset($attrs['where'])) {
            $where = $attrs['where'];
        } else {
            $where = array();
        }
        $key = $CI->metadata->table_key($attrs['table']);
        $list = $CI->attribute->selector($attrs['table'], $key, $where, $attrs);

        return form_dropdown($field, $list, $value);

    }

    /**
     * Return the validation rules deduced from metadata
     *
     * rules is invoked in form validation method, metadata must be loaded on demand.
     *
     * There is no way to get the input wrong with a selector, however rules are used
     * on the server side, so they protect the coherency enven when the request
     * for edition or creation does not come from an official form.
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @param unknown_type $action
     *
     */
    function rules($table, $field, $action) {
        return parent::rules($table, $field, $action);
    }
}

