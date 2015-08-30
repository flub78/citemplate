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
 *    Example de helper
 */
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');


if (!function_exists('datatable')) {
	/**
	 * Generate datatable HTML table
	 * @param unknown_type $table
	 * @param unknown_type $data
	 * @param unknown_type $filter
	 */
	function datatable ($table, $data=array(), $filter=array()) {
		return "";
	}
}

if (!function_exists('field_label')) {
	/**
	 * Generate a form field label
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @param unknown_type $attrs
	 */
	function field_label ($table, $field, $attrs=array()) {
		return "";
	}
}

if (!function_exists('field_input')) {
	/**
	 * Generate a form field input
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @param unknown_type $data
	 * @param unknown_type $attrs
	 */
	function field_input ($table, $field, $data = '', $attrs=array()) {
		return "";
	}
}

if (!function_exists('form')) {
	/**
	 * Generate a basic form
	 * @param unknown_type $table
	 * @param unknown_type $data
	 * @param unknown_type $attrs
	 * @return string
	 */
	function form ($table, $data=array(), $attrs=array()) {
		return "";
	}
}


