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
	protected $table_exist;
	protected $list_fields;
	protected $field_data;
		
	/**
	 * Constructor
	 */
	public function __construct($attrs = array ()) {
		$this->CI = & get_instance ();
		
		# initialize the caches
		$this->table_exist = array();
		$this->list_fields = array();
		$this->field_data = array();
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
				$this->list_fields[$table] = $this->CI->db->list_fields($table);
				$fields = $this->CI->db->field_data($table);
				foreach ($fields as $field) {
					$this->field_data[$table][$field->name] = $field;
				}
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
	 * Check if a filed exists in database
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	function field_exist($table, $field) {
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
	function type($table, $field) {
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
	function subtype($table, $field) {
		if (!$this->table_exists($table)) {
			throw new Exception("Table $table does not exist");
		}
		
		$subtype = array (
				'email' => "email",
				'username' => "text",
				'privilege_name' => "text",
				'privilege_description' => "text",
				
				'password' => "password",
				'confirm-password' => "password" 
		);
		return $subtype[$field];
	}

	/**
	 * Returns the field size
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function size($table, $field) {
			if (!$this->table_exists($table)) {throw new Exception("Table $table does not exist");}
		return 25;
	}

	/**
	 * Returns the field placeholder
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function placeholder($table, $field) {
		if (!$this->table_exists($table)) {throw new Exception("Table $table does not exist");}
		return "";
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

