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

	// backup order, the database is restored in the order of the list. All referenced tables
	// must already exist before each restored one. Put the tables that depends on others ones
	// on bottom of the list.
	// Everything which is referenced by another table must be above the referencing table

	protected $application_tables = array (
	        'migrations',
	        'users',
	        'groups',
	        'users_groups',
	        'login_attempts',
	        'meta_test2',
	        'meta_test1'
	);

	protected $application_views = array (
	        'users_groups_view'
	);

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

		$dt = date("Ymd_His");
		$format = 'zip';
		if ($type == "" | $type == 'backup') {
			$filename = "backup_$dt.zip";
			$add_drop = TRUE;
			$add_insert = TRUE;
			$list = $this->application_tables;
		} else
			if ($type == "structure") {
			$filename = "structure_$dt.sql";
			$add_drop = FALSE;
			$add_insert = FALSE;
			$format = 'txt';
			$list = $this->application_tables;
		} else
			if ($type == "views") {
			$filename = "views_$dt.zip";
			$add_drop = FALSE;
			$add_insert = FALSE;
			$list = $this->application_views;
		} else {
			$filename = "defaut_$dt.zip";
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
				'tables' => $list
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
	    $this->CI->db->query('SET FOREIGN_KEY_CHECKS=0;');
		foreach ($this->application_tables as $table) {
			$this->CI->dbforge->drop_table($table);
		}
		foreach ($this->application_views as $table) {
		    $sql = "DROP VIEW `$table`";
		    $this->CI->db->query($sql);
		}
		$this->CI->db->query('SET FOREIGN_KEY_CHECKS=1;');
	}

	public function sql ($sql, $return_result = false) {
		$this->CI->db->query("SET sql_mode='NO_AUTO_VALUE_ON_ZERO'");
		$reqs = preg_split("/;\n/", $sql); // on sépare les requêtes
        $all_results = array();
		foreach ($reqs as $req) { // et on les éxécute
			if (trim($req) != "") {
			    // echo "req = '$req'<br>";

				if (preg_match('/.*utf8_general_ci$/', $req)) {
				    continue;
				}
				$res = $this->CI->db->query($req);
				if ($return_result && $res)
	                $all_results[] = $res->result_array();
			}
		}
        return $all_results;
	}
}