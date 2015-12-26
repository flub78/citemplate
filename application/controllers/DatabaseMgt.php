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
 * @filesource Rights.php
 * @package controllers
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rights controller
 * @author frederic
 *
 */
class DatabaseMgt extends MY_Controller {

	var $logger;

	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();
		$this->load->library('database');
	}

	/**
	 * Save the database
	 * @param $type = backup|structure|default
	 */
	function backup ($type = 'backup') {
		$this->database->backup($type);
	}

	/**
	 * Restore the database
	 */
	function restore () {
		$error = array (
            'error' => '',
			'erase_db' => 1,
			'title' => 'Restore database'
            );
        $this->load->view('admin/restore_form', $error);
	}

	/**
	 * Restaure la base
	 * TODO utiliser le helper database
	 */
	public function do_restore() {

		$upload_path = './uploads/restore/';
		if (!file_exists($upload_path)) {
			if (!mkdir ($upload_path)) {
				die ("Cannot create " . $upload_path);
			}
		}

		// delete all files in the uploads/restore directory
		$files = glob($upload_path . '*'); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file))
				unlink($file); // delete file
		}

		// upload archive
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'zip';
		$config['max_size'] = '500';

		$this->load->library('upload', $config);

		$erase_db = $this->input->post('erase_db');

		if (!$this->upload->do_upload()) {
			// On a pas réussi à recharger la sauvegarde
			$error = array (
					'error' => $this->upload->display_errors(),
					'erase_db' => 1
			);
			$this->load->view('admin/restore_form', $error);
		} else {

			// on a rechargé la sauvegarde
			$data = $this->upload->data();

			$this->load->library('unzip');
			$filename = $config['upload_path'] . $data['file_name'];
			$orig_name = $config['upload_path'] . $data['orig_name'];
			$this->unzip->extract($filename, $upload_path);

			// $sqlfile = str_replace('.zip', '.sql', $orig_name);
			$sqlfiles = glob($upload_path . '*.sql');
			$sqlfile = $sqlfiles[0];
			$sql = file_get_contents($sqlfile);

			// remove the uncompressed file
			unlink($sqlfile);
			// remove the zip file
			// $this->unlink_zip($filename);
			unlink($filename);

			if ($erase_db) {
				$this->database->drop_all();
			}
			$this->database->sql($sql);

			$this->lang->load('admin');
			$data['title'] = translation('admin_title_restore');
			$data['message'] = translation('admin_db_success'). " " . $data['file_name'];
			$this->load->view('message', $data);
		}
	}

	/**
	 * Migration of the database
	 */
	function migration() {
		echo "migration";
	}

	/**
	 * Restore to factory configuration
	 */
	function reset() {
		$this->database->drop_all ();

		// after database reset nothing works any more
		// so we must logout so a new installation is triggered
		$this->ion_auth->logout();
		redirect(base_url());

// 		$this->lang->load ( 'admin' );
// 		$data ['title'] = translation ( 'admin_title_reset' );
// 		$data ['message'] = translation ( 'admin_reset_success' );
// 		$this->load->view ( 'message', $data );
	}
}
