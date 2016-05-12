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
 * Database management
 * 
 * This libraries provides both global services for the WEB application
 * - backup to backup the database 
 * - drop_all to delete and recreate the tables
 * - sql a basic access to the database mainly used to restore an application database backup
 * 
 * and also database access to the PHPUNIT tests
 * - drop to delete the databse using mysql CLI (to cleanup)
 * - create to create a database using mysql CLI 
 * - restore to reload a database using mysql CLI (to quickly reload a test database)
 * 
 * Others test related entries are
 * - table_list to get the list of table in a database
 * - table_count to get the number of elements of a table (or use the generic model)
 * 
 * Note that these low level routines are not recommended for complex database access. For complex 
 * queries, better to use and enhance on demand the generic model in core/My_Model.php or
 * develop specific model routines.
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
	        'users_groups_view', 'users_view'
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
	 * Drop and recreate the database
	*/
	public function drop_all () {
	    $database = $this->CI->db->database;
	    if ($this->CI->dbforge->drop_database($database))
	    {
	        echo "Database $database deleted!" . br() . "\n";
	    }
	    if ($this->CI->dbforge->create_database($database))
	    {
	        echo "Database $database created!" . br() . "\n";
	    }
	}

	public function sql ($sql, $return_result = false) {
		$this->CI->db->query("SET sql_mode='NO_AUTO_VALUE_ON_ZERO'");
		$reqs = preg_split("/;\n/", $sql); // on sépare les requêtes
        $all_results = array();
		foreach ($reqs as $req) { // et on les éxécute
			if (trim($req) != "") {
			    // echo "req = '$req'\n";

				if (preg_match('/.*utf8_general_ci$/', $req)) {
				    continue;
				}
				$res = $this->CI->db->query($req);
				// var_dump($res->result());
				
				if ($return_result && $res)
	                $all_results[] = $res->result_array();
			}
		}
        return $all_results;
	}
	
	/**
	 * restore a database using msql CLI
	 * @param unknown $filename
	 * @param string $user
	 * @param string $password
	 * @param string $database
	 */
	public function restore($filename, $user="", $password="", $database="", $reset=false) {
		if ($reset) {
			$this->drop_all();
        	$this->CI->db->close();
        	$this->CI->load->database();
		}
		$cmd = "mysql --user=$user --password=$password $database < $filename";
		system($cmd);
	}
		
	/**
	 * Return the list of table in the database
	 */
	public function show_tables () {
		$result = $this->sql('show tables;', true);
		$res = array();
		$database = $this->CI->db->database;
		foreach ($result[0] as $table) {
			$res[] = $table['Tables_in_' . $database];
		}
		return $res;
	}
}