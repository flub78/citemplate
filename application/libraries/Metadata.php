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
		
	/**
	 * Constructor
	 */
	public function __construct($attrs = array ()) {
		$this->CI = & get_instance ();
		# initialize the caches
		$this->table_exist = array();
		$this->list_fields = array();
	}
 
	/**
	 * Check if a table or view exist in the database
	 * @param unknown $table
	 */
	function table_exists ($table) {
		if (array_key_exists($table, $this->table_exist)) {
			$this->table_exist[$table] = $this->CI->db->table_exists($table);
		}
		return $this->table_exist[$table];
	}

	/**
	 * Return the list of fields of a table
	 * @param unknown $table
	 */
	function list_fields ($table) {
		if (array_key_exists($table, $this->list_fields)) {
			$this->list_fields[$table] = $this->CI->db->list_fields($table);
		}
		return $this->list_fields[$table];
	}
	
}

