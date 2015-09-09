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

if (!function_exists('table_from_array')) {
	/**
	 * Generates a html table from an array of rows
	 * Each rows must be an array of cells
	 * @return string
	 * TODO check for incorrect parameter type
	 */
	function table_from_array($table, $attrs = array()) {
		$class = isset($attrs['class']) ? $attrs['class'] : '';
		$res = "";
		$res .= "<table class=\"$class\">\n";

		if (array_key_exists('title', $attrs)) {
			$title = $attrs['title'];
			$res .= "\t<caption>$title</caption>\n";
		}
		$alignments = (array_key_exists('align', $attrs))
		? $attrs['align']
		: array();

		if (array_key_exists('fields', $attrs)) {
			$res .= "\t<thead>";
			$res .= "<tr>";
			$cnt = 0;
			foreach ($attrs['fields'] as $field) {
				$align = (array_key_exists($cnt, $alignments))
				? 'align="' . $alignments[$cnt] . '"'
						: "";
				$res .= "\t\t<th $align class=\"ui-state-default\" >";
				$res .= $field;
				$res .= "</th>\n";
				$cnt++;
			}
			$res .= "</tr>";
			$res .= "</thead>\n";
		}

		$line_cnt = 0;
		foreach ($table as $row) {
			$line_cnt++;
			if ($line_cnt % 2)  {
				$res .= "\t<tr class=\"odd\"  >";
			} else {
				$res .= "\t<tr class=\"even\"  >";
			}
			$cnt = 0;
			foreach ($row as $cell) {
				$align = (array_key_exists($cnt, $alignments))
				? 'align="' . $alignments[$cnt] . '"'
						: "";
				$res .= "\t\t<td $align>";
				$res .= $cell;
				$res .= "</td>\n";
				$cnt++;
			}
			$res .= "\t</tr>\n";
		}
		$res .= "</table>\n";
		return $res;
	}
}
