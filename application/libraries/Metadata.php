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
 * @filesource Metadata.php
 * @package libraries
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The metadata helper provides a functional API to metadata services.
 * This class singleton is in charge of fetching the information from the database
 * and to cache it.
 * 
 * For performance, metadata are only fetched once and on demand from database
 * even if the same information is used several times to build a view.
 * 
 * @author frederic
 *
 */
class Metadata {
	protected $CI;
	protected $table_exist; 	# database metadata
	protected $list_fields;     # database metadata
	protected $field_data;      # database metadata
	protected $fields;	        # additional metadata 
	
	/**
	 * Constructor
	 */
	public function __construct($attrs = array ()) {
		$this->CI = & get_instance ();
		
		# initialize the caches
		$this->table_exist = array();
		$this->list_fields = array();
		$this->field_data = array();
		$this->init();
	}
	
	/**
	 * Initialize the fields metadata 
	 */
	protected function init() {
		
		$this->fields = array();
		
		$this->fields['ciauth_user_accounts']['email'] = array('subtype' => 'email');
		$this->fields['ciauth_user_accounts']['username'] = array('subtype' => 'text');
		$this->fields['ciauth_user_accounts']['password'] = array('subtype' => 'password');
		$this->fields['ciauth_user_accounts']['admin'] = array('subtype' => 'boolean');

		$this->fields['ciauth_user_privileges']['privilege_id'] = array('subtype' => 'int');
		$this->fields['ciauth_user_privileges']['privilege_name'] = array('subtype' => 'text');
		$this->fields['ciauth_user_privileges']['privilege_description'] = array('subtype' => 'text');
	}
 	
	/**
	 * Check if a table or view exist in the database
	 * The routine also fetch table information
	 * @param unknown $table
	 */
	function table_exists ($table) {
		if (!array_key_exists($table, $this->table_exist)) {
			$this->table_exist[$table] = $this->CI->db->table_exists($table);
			
			if ($this->table_exist[$table]) {
				
				# fetch database metadata
				$this->list_fields[$table] = $this->CI->db->list_fields($table);
				$fields = $this->CI->db->field_data($table);
				# var_dump($fields);
				foreach ($fields as $field) {
					$this->field_data[$table][$field->name] = $field;
				}
				
				# fetch additional metadata
				
			}
		}
		return $this->table_exist[$table];
	}

	/**
	 * Return the list of fields of a table
	 * @param unknown $table
	 */
	function list_fields ($table) {
		if (!$this->table_exists($table)) {throw new Exception("Table $table does not exist");}
		
		return $this->list_fields[$table];
	}
	
	/**
	 * Check if a field exists in database
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	function field_exists($table, $field) {
		if (!$this->table_exists($table)) {
			return false;
		}
		return array_key_exists($field, $this->field_data[$table]);	
	}
	
	/**
	 * Returns the field type
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_type($table, $field) {
		if (!$this->table_exists($table)) {throw new Exception("Table $table does not exist");}
		$type = $this->field_data[$table][$field]->type;
		return $type;
	}
	
	/**
	 * Returns the field subtype
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_subtype($table, $field) {
		if (!$this->field_exists($table, $field)) {throw new Exception("Field $field does not exist in table $table");}
		
		if (! isset($this->fields[$table][$field]['subtype'])) {
			throw new Exception("Undefined subtype for table$$table, field=$field");
		}
		return $this->fields[$table][$field]['subtype'];
	}

	/**
	 * Returns the field size
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_size($table, $field) {
		if (!$this->field_exists($table, $field)) {throw new Exception("Field $field does not exist in table $table");}
		$size = $this->field_data[$table][$field]->max_length;
		return $size;
	}
	
	/**
	 * Returns the field default
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_default($table, $field) {
		if (!$this->field_exists($table, $field)) {
			throw new Exception("Field $field does not exist in table $table");
		}
		$default = $this->field_data[$table][$field]->default;
		return $default;
	}
	

	/**
	 * Returns the field placeholder
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_placeholder($table, $field) {
		if (!$this->field_exists($table, $field)) {throw new Exception("Field $field does not exist in able $table");}

		if (! isset($this->fields[$table][$field]['placeholder'])) {
			return "";
		}
		return $this->fields[$table][$field]['placeholder'];		
	}

	/**
	 * Log information on the metadata logger
	 * @param unknown_type $msg
	 * @param unknown_type $level
	 */
	function log($msg, $level = "info") {
		echo $msg;
	}
}

