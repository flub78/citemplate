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
 *	  Resources path and URL management
 *
 */
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

if (!function_exists('css_url')) {
	/**
	 * Base URL for the theme
	 * @return string
	 */
	function theme_url() {
		$CI = & get_instance();
		$theme = $CI->config->item('theme');
		return base_url() . "themes/" . $theme;
	}
}

if (!function_exists('css_url')) {
	/**
	 * base URL for CSS
	 * @param unknown_type $nom
	 * @return string
	 */
	function css_url($nom) {
		return theme() . "/css/" . $nom . '.css';
	}
}

if (!function_exists('js_url')) {
	/**
	 * Base URL for Javascript
	 * @param unknown_type $nom
	 * @return string
	 */
	function js_url($nom) {
		return base_url() . 'assets/javascript/' . $nom . '.js';
	}
}

if (!function_exists('bootstrap_url')) {
	/**
	 * Base URL for bootstrap
	 * @return string
	 */
	function boostrap_url() {
		return base_url() . 'bootstrap/';
	}
}

if (!function_exists('bootstrap_css')) {
	/**
	 * CSS URL for bootstrap
	 * @param unknown_type $nom
	 * @return string
	 */
	function boostrap_css($name) {
		return bootstrap_url() . 'css/' . $name . '.css';
	}
}

if (!function_exists('bootstrap_js')) {
	/**
	 * Javascript URL for bootstrap
	 * @param unknown_type $name
	 * @return string
	 */
	function boostrap_js($name) {
		return bootstrap_url() . 'js/' . $name . '.js';
	}
}


if (!function_exists('image_dir')) {
	/**
	 *
	 * Répèrtoire de stockage des images, graphs, etc
	 */
	function image_dir() {
		return 'assets/images/';
	}
}

if (!function_exists('img_url')) {
	/**
	 * Base URL for images
	 * @param unknown_type $nom
	 * @return string
	 */
	function img_url($nom) {
		return theme() . '/images/' . $nom;
	}
}

if (!function_exists('asset_url')) {
	function asset_url($nom) {
		return theme() . '/assets/' . $nom;
	}
}

if (!function_exists('controller_url')) {
	function controller_url($nom) {
		return site_url() . '/' . $nom;
	}
}

if (!function_exists('jqueryui_theme')) {
	function jqueryui_theme () {
		$CI = & get_instance();
		if($CI->config->item('palette')) {
			return $CI->config->item('palette');
		}
		return "base";
	}
}