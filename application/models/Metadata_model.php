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
 * @filesource Metadata_model.php
 * @package model
 * Model for metadata
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Metadata_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function tables() {
		$res = $this->db->query('show tables');
		
		$tables = array();
		foreach ($res->result_array() as $row) {
			foreach ($row as $key => $table) {
				$tables[] = $table;
		
// 				// look for fields for each table
// 				$sql = "show full fields from $table";
// 				$res = $this->db->query($sql);
// 				foreach ($res->result_array() as $row) {
// 					$field = $row['Field'];
// 					$this->fields[$table][] = $field;
// 					$this->field[$table][$field] = $row;
// 					if (isset ($row['Key']) && ('PRI' == $row['Key'])) {
// 						// echo "key[$table]=$field" . br();
// 						$this->keys[$table] = $field;
// 					}
// 				}
			}
		}
		
		return $tables;
	}

}
/* End of file */