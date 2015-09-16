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
 *    the metada description. The metadata librarie is in charge of fetching
 *    table and fields descriptions. 
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
		
		if (count ( $fields ) == 0) {
			// default, all fields
			if ($CI->metadata->table_exists ( $table )) {
				$fields = $CI->metadata->list_fields ( $table );
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
		
		// insert heading row
		$res = array (
				heading_row ( $table, $fields ) 
		);
		
		foreach ( $data as $elt ) {
			
			$id = $elt [table_key ( $table )];
			
			// Select useful columns
			$row = array ();
			foreach ( $fields as $field ) {
				if ($field == "__edit") {
					$row [] = edit_button ( $controller, $id );
				} elseif ($field == "__delete") {
					$row [] = delete_button ( $controller, $id );
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

if (! function_exists ( 'field_label' )) {
	/**
	 * Generate a form field label
	 * 
	 * @param unknown_type $table        	
	 * @param unknown_type $field        	
	 * @param unknown_type $attrs        	
	 */
	function field_label($table, $field, $attrs = array()) {
		return "";
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
	function field_input($table, $field, $data = '', $attrs = array()) {
		$fields = array (
				'email' => '<input type="email" name="email_value" value="" id="email_value" class="form-control" placeholder="Email Address" size="25"  />',
				'username' => '<input type="text" name="username_value" value="" id="username_value" class="form-control" placeholder="User Name" size="25"  />',
				'password' => '<input type="password" name="password" value="" id="password" class="form-control" placeholder="Password" size="25"  />',
				'confirm-password' => '<input type="password" name="confirm-password" value="" id="confirm-password" class="form-control" placeholder="Confirm Password" size="25"  />' 
		);
		return $fields [$field];
	}
}

if (! function_exists ( 'form_field_list' )) {
	/**
	 * Returns the list of fields to be displayed in the form
	 * 
	 * @param unknown_type $table        	
	 */
	function form_field_list($table) {
		$list = array (
				'ciauth_user_accounts' => array (
						'email',
						'username',
						'password',
						'confirm-password' 
				) 
		);
		return $list [$table];
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
			$res .= tabs ( 4 ) . field_label ( $table, $field ) . field_input ( $table, $field ) . "\n";
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
		return "privilege_id";
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

