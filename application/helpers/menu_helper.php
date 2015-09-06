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
 *    This helper just provides a functional API to the Menu library.
 */
if (!defined('BASEPATH')) exit ('No direct script access allowed');


if (!function_exists('html_menu')) {

	/**
	 * Translate a menu description into an HTML list
	 */
// 	function html_menu($menu, $level = 0, $li = false, $button_class = "") {
// 		$CI = & get_instance();
// 		return $CI->menu->html($menu, $level, $li, $button_class);
// 	}
}

if (!function_exists('bootstrap_menu')) {
	/**
	 * Translate a menu description into an HTML structure list usable in bootstrap navbar
	 */
	function bootstrap_menu($menu, $level = 0, $li = false, $button_class = "") {
		$CI = & get_instance();
		return $CI->menu->bootstrap_html($menu, $level, $li, $button_class);
	}
}
