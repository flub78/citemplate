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
 *    We need the url for
 *   - css used by the project
 *   - bootstrap css
 *   - overlaping css for cutomisation (theme)
 * they could be named project_css, bootstap_css and theme_css,
 * project_js, bootstrap_js and theme_js
 *
 */
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

if (!function_exists('project_css')) {
	/**
	 * base URL for CSS
	 * @param unknown_type $nom
	 * @return string
	 */
	function project_css($nom) {
		return base_url() . "css/" . $nom . '.css';
	}
}

if (!function_exists('project_js')) {
	/**
	 * base URL for Javascript
	 * @param unknown_type $nom
	 * @return string
	 */
	function project_js($nom) {
		return base_url() . "js/" . $nom . '.js';
	}
}

if (!function_exists('theme_url')) {
	/**
	 * Base URL for the theme
	 * @return string
	 */
	function theme_url() {
		$CI = & get_instance();
		$theme = $CI->config->item('theme');
		if (!$theme) {
			$theme = 'default';
		}
		return base_url() . "themes/" . $theme;
	}
}

if (!function_exists('theme_css')) {
	/**
	 * base URL for CSS
	 * @param unknown_type $nom
	 * @return string
	 */
	function theme_css($nom) {
		return theme_url() . "/css/" . $nom . '.css';
	}
}

if (!function_exists('theme_js')) {
	/**
	 * base URL for Javascript
	 * @param unknown_type $nom
	 * @return string
	 */
	function theme_js($nom) {
		return theme_url() . "/js/" . $nom . '.js';
	}
}


if (!function_exists('bootstrap_url')) {
	/**
	 * Base URL for bootstrap
	 * @return string
	 */
	function bootstrap_url() {
		return base_url() . 'bootstrap/';
	}
}

if (!function_exists('bootstrap_css')) {
	/**
	 * CSS URL for bootstrap
	 * @param unknown_type $nom
	 * @return string
	 */
	function bootstrap_css($name) {
		return bootstrap_url() . 'css/' . $name . '.css';
	}
}

if (!function_exists('bootstrap_js')) {
	/**
	 * Javascript URL for bootstrap
	 * @param unknown_type $name
	 * @return string
	 */
	function bootstrap_js($name) {
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
		return theme_url() . '/images/' . $nom;
	}
}

if (!function_exists('asset_url')) {
	function asset_url($nom) {
		return theme_url() . '/assets/' . $nom;
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