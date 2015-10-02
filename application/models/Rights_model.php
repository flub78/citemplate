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
 * @filesource Crud_model.php
 * @package model
 * 
 * The CRUD model is a standard model for CRUD access. All its implementation
 * is done in MY_Model
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Rights_model extends MY_Model {

	/**
	 * This string identifies an element in human readable maned.
	 * Likely overloaded.
	 * @param $key identifiant de la ligne à représenter
	 */
	public function image($table, $key) {
		///$vals = $this->get_by_id('vaid', $key);
		$img = "<<<" . $key . ">>>";
		return $img;
	}
	
}
/* End of file */