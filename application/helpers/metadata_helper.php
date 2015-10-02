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
 *    The metadata helper is in charge of generating views element using 
 *    the metada description. It is a helper because object oriented syntax
 *    brings an overhead to views.
 *    The metadata librarie is in charge of fetching table and fields 
 *    descriptions. It is a class because it provides both persistend data
 *    and access method. 
 *    
 *    Metadata supports several subtypes of data
 *    * varchar
 *       * emails dot separated strings with one @
 *       * password
 *       * url
 *       * key to others table
 *       
 *    * tinyint
 *       * booleans
 *       
 *    * int
 *       * enumerates
 *       * keys to others tables 
 *       
 *    * decimal
 *       * currency
 *       
 *    * date
 *    * timestamp
 *    
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! function_exists ( 'heading_row' )) {
	/**
	 * Return an Array of labels for datatable
	 * 
	 * @param unknown_type $table        	
	 * @param unknown_type $fields
	 *        	= array()
	 */
	function heading_row($table, $fields = array()) {
		$CI = & get_instance ();
		
		if (!$CI->metadata->table_exists($table)) {return array();};
		
		if (count ( $fields ) == 0) {
			// default, all fields
			if ($CI->metadata->table_exists ( $table )) {
				$fields = $CI->metadata->fields_list ( $table );
			}
		}
		
		$res = array ();
		foreach ( $fields as $field ) {
			$translated = $CI->lang->line ( "heading_" . $field );
			if (preg_match ( '/^__/', $field )) {
				$res [] = '';
			} elseif ($translated) {
				$res [] = $translated;
			} else {
				$res [] = $field;
			}
		}
		return $res;
	}
}

if (! function_exists ( 'datatable' )) {
	/**
	 * Generate a two dimentional array for HTML display or export
	 * 
	 * @param unknown_type $table        	
	 * @param unknown_type $data        	
	 * @param unknown_type $filter        	
	 */
	function datatable($table, $data = array(), $attrs = array()) {
		$fields = (array_key_exists ( 'fields', $attrs )) ? $attrs ['fields'] : array ();
		$controller = (array_key_exists ( 'controller', $attrs )) ? $attrs ['controller'] : $table;
		
		$CI = & get_instance ();
		if (!$CI->metadata->table_exists($table)) {
			return "";
		};
		
		// insert heading row
		$res = array (
				heading_row ( $table, $fields ) 
		);
		
		foreach ( $data as $elt ) {
			
			$id = $elt [table_key ( $table )];
			$image = $CI->model->image($table, $id);
			// echo "image=$image"; exit;
			// Select useful columns
			$row = array ();
			foreach ( $fields as $field ) {
				if ($field == "__edit") {
					$row [] = edit_button ( $controller, $id );
				} elseif ($field == "__delete") {
					$row [] = delete_button ( $controller, $id, $image);
				} else {
					// regular data field
					$row [] = $elt [$field];
				}
			}
			// Add actions and special field
			$res [] = $row;
		}
		
		return $res;
	}
}

if (! function_exists ( 'table_title' )) {
	/**
	 * Return the title for a table
	 *
	 * @param unknown_type $table
	 */
	function table_title($table) {
		$CI = & get_instance();
		$title = $CI->lang->line('title_' . $table);

		return ($title) ? $title : $table;
	}
}

if (! function_exists ( 'form_title' )) {
	/**
	 * Return the title for a form
	 *
	 * @param unknown_type $table
	 */
	function form_title($table, $action) {
		$CI = & get_instance();
		$title = $CI->lang->line('title_' . $table . "_$action");
		
		if ($title) {
			return $title;
		}

		$title = $CI->lang->line('title_' . $table . "_form");
		
		return ($title) ? $title : $table;
	}
}

if (! function_exists ( 'field_label_text' )) {
	/**
	 * Generate a form field label
	 * 
	 * @param unknown_type $table        	
	 * @param unknown_type $field        	
	 * @param unknown_type $attrs        	
	 */
	function field_label_text($table, $field) {
		$CI = & get_instance();
		$label = $CI->lang->line('label_' . $table . '_' . $field);
		
		return ($label) ? $label : "";
	}
}

if (! function_exists ( 'field_label' )) {
	/**
	 * Generate a form field label
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @param unknown_type $attrs
	 */
	function field_label($table, $field, $attrs = array()) {

		$CI = & get_instance ();
		
		$text = field_label_text($table, $field);
		
		if ($text) {
			$id = $CI->metadata->field_id ($table, $field);
		
			return '<label for="' . $id . '">' . $text . '</label>';
		} else {
			return "";
		}
	}
}

if (! function_exists ( 'field_name' )) {
	/**
	 * Return the field name
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @param $full use full name to avoid name collision
	 */
	function field_name($table, $field, $full = false) {

		$CI = & get_instance ();
		return $CI->metadata->field_name ($table, $field, $full);		
	}
}


if (! function_exists ( 'field_input' )) {
	/**
	 * Generate a form field input
	 * 
	 * @param unknown_type $table        	
	 * @param unknown_type $field        	
	 * @param unknown_type $data        	
	 * @param unknown_type $attrs        	
	 */
	function field_input($table, $field, $value = '', $attrs = array()) {
		$CI = & get_instance ();
				
		$type = $CI->metadata->field_type ($table, $field);
		$name = $CI->metadata->field_name ($table, $field);
		$id = $CI->metadata->field_id ($table, $field);
		# $db_type = $CI->metadata->field_db_type ($table, $field);
		$size = $CI->metadata->field_size ($table, $field);
		$placeholder = $CI->metadata->field_placeholder ($table, $field);
		
		$info = "field_input($table, $field) ";
		$info .= "type=$type, size=$size, placeholder=$placeholder";		
		$CI->metadata->log($info);
		
		// The first time used $value, then re-populate from the form
		$value = set_value($name, $value);
		
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
		$input .= " class=\"form-control\"";
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
}

if (! function_exists ( 'form_field_list' )) {
	/**
	 * Returns the list of fields to be displayed in the form
	 * 
	 * @param unknown_type $table        	
	 */
	function form_field_list($table) {
		$CI = & get_instance ();
		
		return $CI->metadata->form_field_list ($table);		
	}
}

if (! function_exists ( 'form' )) {
	/**
	 * Generate a basic form
	 * 
	 * @param unknown_type $table        	
	 * @param unknown_type $data        	
	 * @param unknown_type $attrs        	
	 * @return string
	 */
	function form($table, $data = array(), $attrs = array()) {
		$res = "";
		foreach ( form_field_list ( $table ) as $field ) {
			$value = (isset($data[$table][$field])) ? $data[$table][$field] : "";
			$res .= tabs ( 4 ) . field_label ( $table, $field ) . field_input ( $table, $field, $value) . "\n";
		}
		$res .= '<div class="g-recaptcha" data-sitekey="6LdlegoTAAAAAD4wEuXR1IIeru34DhdPN1DYKTNH"></div>' . "\n";
		$res .= '' . "\n";
		return $res;
	}
}

if (! function_exists ( 'submit' )) {
	/**
	 * Generate a basic form
	 * 
	 * @param unknown_type $table        	
	 * @param unknown_type $data        	
	 * @param unknown_type $attrs        	
	 * @return string
	 */
	function submit($label, $attrs = array()) {
		$res = '<button name="submit" type="submit" id="submit_button" ';
		$res .= 'class="btn btn-lg btn-primary btn-block" value="submit" >' . $label . '</button>';
		return $res;
	}
}

if (! function_exists ( 'table_key' )) {
	/**
	 *
	 * return the name of the column containing the element id
	 * 
	 * @param unknown_type $table        	
	 */
	function table_key($table) {
		$CI = & get_instance ();		
		return $CI->metadata->table_key($table);
	}
}

if (! function_exists ( 'autogen_key' )) {
	/**
	 * Returns the key when autogenerated, FALSE if not
	 * 
	 * @param unknown_type $table        	
	 */
	function autogen_key($table) {
		// $key = $this->table_key($table);
		// if ($this->field_attr($table, $key, 'Extra') == 'auto_increment') {
		// return $key;
		// }
		return FALSE;
	}
}

if (! function_exists ( 'rules' )) {
	/**
	 * Return the validation rules deduced from metadata
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	function rules($table, $field) {
		$CI = & get_instance();
		return $CI->metadata->rules($table, $field);		
	}
}

