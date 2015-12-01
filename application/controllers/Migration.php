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
 * Migration de la base de données
 *
 * @filesource migration.php
 * @package controllers
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends MY_Controller {

	protected $controller = "migration";
	protected $unit_test = FALSE;

	/**
	 * Constructor
	 */
	function __construct() {
		parent :: __construct();

		$this->load->library('Database');
		$this->load->helper('file');
		$this->load->library('migration');
		$this->config->load('migration');
	}

	
	/**
	 * Fait migrer la base vers une version données
	 *
	 */
	public function to_level() {
	
		$target_level = $this->input->post('target_level');
		$program_level = $this->input->post('program_level');
		$base_level = $this->input->post('base_level');
		
		if ($target_level != $base_level) {
			if ( ! $this->migration->version($target_level))
			{
				echo "migration to $target_level" . br();
				show_error($this->migration->error_string());
				return;
			}
		}
		$this->index();
	}
	
	/**
	 * Display the migration control page
	 */
	public function index () {
		
		$program_level = $this->config->item('migration_version');
		$data['program_level'] = $program_level;
		$data['migrations'] = $this->migration->find_migrations();
		$data['title'] = translation('');
echo "program= $program_level";
var_dump($data['migrations']);
// 		return;
// 		$levels = array();
// 		for ($i = $program_level; $i >= 1; $i--) {
// 			$levels[$i] = $i;
// 		}
// 		$data['levels'] = $levels;
		
		$this->load->view('migration/avant', $data);
	}

}