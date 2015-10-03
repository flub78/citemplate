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
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Development controller
 * @author frederic
 *
 */
class Dev extends MY_Controller {

	function __construct() {
		parent :: __construct();
		$this->load->language("dev");
	}

	/**
	 * Display phpinfo
	 */
	public function phpinfo()
	{
		phpinfo();
	}

	/**
	 * Display info
	 */
	public function info()
	{
		echo "base_url=" . base_url() . br();
		echo "site_url=" . site_url() . br();
		echo "current_url=" . current_url() . br();
	}

	/*
	 * Convert a language file into a hash
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
		$fields = $this->db->field_data('ciauth_user_privileges');
		var_dump($fields);
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
		echo translation("ref_lang") . "=" . $lang_ref . br();
		echo translation("checked_lang") . "=" .$lang .br();
		$data['lang_ref'] = $lang_ref;
		$data['checked_lang'] = $checked_lang;
		
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

	}

}
