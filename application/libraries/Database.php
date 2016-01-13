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
 *
 */
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

/**
 * Database maangement
*/
class Database  {

	// backup order, the database is restored in the reverse order. All referenced tables
	// must already exist before each restored one. Put the tables that depends on others ones
	// on top of the list.
	// So everything which is referenced by another table must be above the referencing table

	protected $application_tables = array (
	        'migrations',
	        'users',
	        'groups',
	        'users_groups',
	        'login_attempts',
	        'meta_test1',
	        'users_groups_view'
	);

	protected $table_list;

	protected $defaut_list = array (
	);


	protected $CI;

	/**
	 * Constructor - Sets DataTableer's Preferences
	 *
	 * The constructor can be passed an array of attributes values
	 */
	public function __construct() {
		$this->CI = & get_instance();
		$this->CI->load->dbforge();

		$this->table_list = array_merge (array (),
				$this->application_tables
		);
	}


	/**
	 * Backup the database
	 *
	 * @param string $type
	 */
	public function backup($type = "") {
		date_default_timezone_set('Europe/Paris');

		// Load the DB utility class
		$this->CI->load->dbutil();

		$dt = date("Y_m_d");
		$format = 'zip';
		if ($type == "" | $type == 'backup') {
			$filename = "backup_$dt.zip";
			$add_drop = TRUE;
			$add_insert = TRUE;
			$list = $this->table_list;
		} else
			if ($type == "structure") {
			$filename = "structure.sql";
			$add_drop = FALSE;
			$add_insert = FALSE;
			$format = 'txt';
			$list = $this->table_list;
		} else {
			$filename = "defaut.sql";
			$add_drop = TRUE;
			$add_insert = TRUE;
			$format = 'txt';
			$list = $this->defaut_list;
		}

		// Backup your entire database and assign it to a variable
		$prefs = array (
				'filename' => $filename,
				'format' => $format,
				'add_insert' => $add_insert,
				'add_drop' => $add_drop,
				'tables' => array_reverse($list)
		);

		$backup = & $this->CI->dbutil->backup($prefs);

		// Load the file helper and write the file to your server
		$this->CI->load->helper('file');

		// Load the download helper and send the file to your desktop
		$this->CI->load->helper('download');
		force_download($filename, $backup);
	}

	/*
	 * Drop all the tables
	*/
	public function drop_all () {
		foreach ($this->application_tables as $table) {
			$this->CI->dbforge->drop_table($table);
		}
	}

	public function sql ($sql, $return_result = false) {
		$this->CI->db->query("SET sql_mode='NO_AUTO_VALUE_ON_ZERO'");
		$reqs = preg_split("/;\n/", $sql); // on sépare les requêtes
        $all_results = array();
		foreach ($reqs as $req) { // et on les éxécute
			if (trim($req) != "") {
				// echo "req = $req<br>";
				$res = $this->CI->db->query($req);
				if ($return_result && $res)
	                $all_results[] = $res->result_array();
			}
		}
        return $all_results;
	}
}