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
 *	  Bootstrap helper
 *
 *	  set of functions to generate Bootstrap HTML elements
 *
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! function_exists ( 'anchor_button' )) {
	/**
	 * Create a bootstrap button
	 * 
	 * @param unknown_type $nb
	 * 
	 * bootstrap style can be applied to <a>, <button>,        
	 */
	function anchor_button($attrs = array()) {
		
		$icon = $attrs['icon'];
		$button = "<a type=\"button\" class=\"btn btn-default btn-lg\"
					aria-label=\"Left Align\">
					<span class=\"glyphicon glyphicon-$icon\" aria-hidden=\"true\"></span>
					</a>";
		return $button;
	}
}

if (! function_exists ( 'edit_button' )) {
	/**
	 * Create a bootstrap button
	 * 
	 * @param unknown_type $nb        	
	 */
	function edit_button($controller, $id) {
		
		return anchor_button(array(
			'icon' => 'pencil',
			'url' => controller_url($controller) . '/edit/' . $id
		));
	}
}

if (! function_exists ( 'delete_button' )) {
	/**
	 * create a delete button
	 * 
	 * @param
	 *        	$controller
	 * @param
	 *        	$id
	 */
	function delete_button($controller, $id) {
		return anchor_button(array(
			'icon' => 'remove',
			'url' => controller_url($controller) . '/delete/' . $id
		));
	}
}
