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
 *	  Additional HTML helpers
 *
 */
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

if (!function_exists('script')) {
	/**
	 * base URL for CSS
	 * @param unknown_type $nom
	 * @return string
	 */
	function script($nom) {
		return '<script src="' . $nom . '"></script>';
	}
}

if (!function_exists('translation')) {

	/**
	 *
	 * @param unknown_type $title_id
	 */
	function translation($title_id = '') {
		$CI = & get_instance();
		$translated = $CI->lang->line($title_id);
		return ($translated) ? $translated : $title_id;
	}
}

if (!function_exists('title')) {

	/**
	 *
	 * @param unknown_type $title_id
	 */
	function title ($title_id = '') {
		return translation($title_id);
	}
}

if (!function_exists('tabs')) {
/**
 * Returns a variable width string of spaces.
 * Generated HTML indentation. It is more convenient to
 * generate clean indented HTML when you need to read it for analysis.
 *
 * @param unknown_type $nb        	
 */
function tabs($nb) {
	$pattern = '    ';
	$res = "";
	for($i = 0; $i < $nb; $i ++) {
		$res .= $pattern;
	}
	return $res;
}
}

if (!function_exists('p')) {
	/**
	 * Generates an HTML paragraph
	 * @param unknown_type $str
	 * @return string
	 */
	function p($str, $attr = '') {
		$res = '<p';
		$res .= ($attr) ? " $attr" : '';
		$res .= '>' . $str . '</p>';
		return $res;
	}
}

