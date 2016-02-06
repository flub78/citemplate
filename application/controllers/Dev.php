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
 * @package controllers
 * Development tools controler
 *
 * It is just a controller for experiments and to display information useful
 * during development. Could be disabled in production.
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

// First, include Requests
include(APPPATH . '/third_party/Requests.php');

// Next, make sure Requests can load internal classes
Requests::register_autoloader();

/**
 * Development controller
 * @author frederic
 *
 */
class Dev extends MY_Controller {

	function __construct() {
		parent :: __construct();
	}

	/**
	 * Display phpinfo
	 */
	public function phpinfo()
	{
		phpinfo();
	}

	/**
	 * Display execution and database schema info
	 */
	public function info()
	{
	    $this->load->model('crud_model', 'model');

		$data = array();
		$data['controller'] = 'dev';
		$data['base_url'] = base_url();
		$data['site_url'] = site_url();
		$data['current_url'] = current_url();
		$data['cwd'] = getcwd();

		$select = $this->model->select_all('information_schema.tables');
        $header = array (
                'TABLE_CATALOG',
                'TABLE_SCHEMA',
                'TABLE_NAME',
                'TABLE_TYPE',
                'ENGINE',
                'VERSION',
                'ROW_FORMAT',
                'TABLE_ROWS',
                'AVG_ROW_LENGTH',
                'DATA_LENGTH',
                'MAX_DATA_LENGTH',
                'INDEX_LENGTH',
                'DATA_FREE',
                'AUTO_INCREMENT',
                'CREATE_TIME',
                'UPDATE_TIME',
                'CHECK_TIME',
                'TABLE_COLLATION',
                'CHECKSUM',
                'CREATE_OPTIONS',
                'TABLE_COMMENT'
        );
        $tables = array_merge(array($header), $select);
		$data['data_tables'] = $tables;


		$header = array ('TABLE_CATALOG', 'TABLE_SCHEMA', 'TABLE_NAME', 'VIEW_DEFINITION',
		        'CHECK_OPTION', 'IS_UPDATABLE', 'DEFINER', 'SECURITY_TYPE', 'CHARACTER_SET_CLIENT', 'COLLATION_CONNECTION'
		);
		$header = array ( 'TABLE_NAME', 'VIEW_DEFINITION');
		$select = $this->model->select('information_schema.views', $header);
		$views = array_merge(array($header), $select);
		$data['data_views'] = $views;

		/**
		 * preg_match
		 * $reqs = preg_split("/;\n/", $sql); // on sépare les requêtes
		 *
		 * select `ci3`.`users`.`username` AS `username`,`ci3`.`groups`.`name` AS `groupname` from ((`ci3`.`users` join `ci3`.`users_groups`) join `ci3`.`groups`) where ((`ci3`.`users`.`id` = `ci3`.`users_groups`.`user_id`) and (`ci3`.`groups`.`id` = `ci3`.`users_groups`.`group_id`))
		 * select `ci3`.`users`.`id` AS `id`,`ci3`.`users`.`ip_address` AS `ip_address`,`ci3`.`users`.`username` AS `username`,`ci3`.`users`.`password` AS `password`,`ci3`.`users`.`salt` AS `salt`,`ci3`.`users`.`email` AS `email`,`ci3`.`users`.`activation_code` AS `activation_code`,`ci3`.`users`.`forgotten_password_code` AS `forgotten_password_code`,`ci3`.`users`.`forgotten_password_time` AS `forgotten_password_time`,`ci3`.`users`.`remember_code` AS `remember_code`,`ci3`.`users`.`created_on` AS `created_on`,`ci3`.`users`.`last_login` AS `last_login`,`ci3`.`users`.`active` AS `active`,`ci3`.`users`.`first_name` AS `first_name`,`ci3`.`users`.`last_name` AS `last_name`,`ci3`.`users`.`company` AS `company`,`ci3`.`users`.`phone` AS `phone`,concat(`ci3`.`users`.`first_name`,' ',`ci3`.`users`.`last_name`) AS `image` from `ci3`.`users`
		 *
		 */

		/**
		 * SELECT `CONSTRAINT_SCHEMA` , `CONSTRAINT_NAME` , `TABLE_SCHEMA` , `TABLE_NAME` , `COLUMN_NAME` , `REFERENCED_TABLE_SCHEMA` , `REFERENCED_TABLE_NAME` , `REFERENCED_COLUMN_NAME`
FROM `KEY_COLUMN_USAGE`
WHERE `CONSTRAINT_SCHEMA` LIKE 'ci3'
AND `CONSTRAINT_NAME` NOT LIKE 'PRIMARY'
LIMIT 0 , 30
		 */

        $header = array('CONSTRAINT_SCHEMA', 'CONSTRAINT_NAME', 'TABLE_SCHEMA', 'TABLE_NAME', 'COLUMN_NAME', 'REFERENCED_TABLE_SCHEMA', 'REFERENCED_TABLE_NAME', 'REFERENCED_COLUMN_NAME');

		$select = $this->model->select('information_schema.KEY_COLUMN_USAGE',
		        $header,
		        array('CONSTRAINT_SCHEMA' => 'ci3', 'CONSTRAINT_NAME !=' => 'PRIMARY'));
		$foreign_keys = array_merge(array($header), $select);
		$data['data_foreign_keys'] = $foreign_keys;

		$this->load->view('test/info', $data);
	}

	/*
	 * Convert a language file into a hash
	 *
	 * Used to compare entries of two languages
	 */
	private function to_hash ($filename) {
		include($filename);
		return $lang;
	}

	/**
	 * Display information on ..
	 */
	public function test()
	{
		$fields = $this->db->field_data('users');
		var_dump($fields);
	}

	/**
	 * Experiment on REST client
	 */
	public function rest_client() {
	    echo "REST client";

	    // Now let's make a request!
	    $request = Requests::get('http://httpbin.org/get', array('Accept' => 'application/json'));

	    // Check what we received
// 	    var_dump($request->status_code);
// 	    var_dump($request->headers);
	    var_dump($request->body);
	}

	function echo_params () {
	    echo "echo_params" . br();
	    echo "\$_SERVER"; var_dump($_SERVER);
	    echo "\$_GET"; var_dump($_GET);
	    echo "\$_POST"; var_dump($_POST);
	}

	/*
	 * Check that the support for a language is complete
	*/
	private function check_entries ($ref_file, $lang_file, $identical) {
		$missing_keys = 0;

		$ref_hash = $this->to_hash($ref_file);
		$lang_hash = $this->to_hash($lang_file);

		foreach ($ref_hash as $key => $value) {
			if (!array_key_exists($key, $lang_hash)) {
				echo nbs(8) . "key $key not found in $lang_file" . br();
				$missing_keys++;
			} else {
				if (is_array($ref_hash[$key]) != is_array($lang_hash[$key])) {
					echo nbs(8) . "incoherent array type for $key" . br();
				} elseif (is_array($ref_hash[$key]) && (count($ref_hash[$key]) != count($lang_hash[$key]))) {
					echo nbs(8) . "different number of array elements for $key" . br();
				} elseif ($identical && ($ref_hash[$key] == $lang_hash[$key])) {
					echo nbs(12) . "value for $key = $value, identical, may be not translated yet" . br();
				}
			}
		}
		return $missing_keys;
	}

	/*
	 * Check that the support for a language is complete
	*/
	public function check_lang ($lang = "french", $identical = 0, $type = "application") {
		$lang_ref = "english";

		$data= array();
		echo "Reference language=" . $lang_ref . br();
		echo "Checked language=" .$lang .br();
		$data['lang_ref'] = $lang_ref;
		$data['checked_lang'] = $lang;

		$missing_files = 0;
		$missing_keys = 0;
		$not_translated = 0;

		$pwd = getcwd();

		$ref_files = array();
		$lang_files = array();

		$ref_dir = $pwd . "/$type/language/" . $lang_ref;
		if (!is_dir($ref_dir)) {
			echo "Reference language $ref_dir not found" . br();
			exit;
		}

		$lang_dir = $pwd . "/$type/language/" . $lang;
		if (!is_dir($lang_dir)) {
			echo "Language directory $lang_dir not found" . br();
			exit;
		}

		echo br();

		# Check that all files are found in the checked language
		if ($dh = opendir($ref_dir)) {
			while (($file = readdir($dh)) !== false) {
				if (preg_match('/.*\.php$/', $file, $matches) ) {
					# echo "fichier : $file : type : " . filetype($ref_dir . $file) . br();
					$ref_files[] = $file;

					$lang_file = $lang_dir . '/' . $file;

					if (!file_exists($lang_file)) {
						echo "$lang_file not found" . br();
						$missing_files++;
					}
				}
			}
			closedir($dh);
		}

		echo br();
		# Check that all entries are found in the checked language
		if ($dh = opendir($ref_dir)) {
			while (($file = readdir($dh)) !== false) {
				if (preg_match('/.*\.php$/', $file, $matches) ) {
					$ref_file = $ref_dir . '/' . $file;
					$lang_file = $lang_dir . '/' . $file;

					if (file_exists($lang_file)) {
						echo "Checking $file" . br();
						$missing_keys += $this->check_entries($ref_file, $lang_file, $identical);
					}
				}
			}
			closedir($dh);
		}

		echo br();
		echo "Missing files = $missing_files, missing entries = $missing_keys" .br();

		$this->load->view(translation('language') . '/dev/check_lang');

	}

}
