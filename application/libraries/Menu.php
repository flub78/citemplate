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
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );


/**
 * Generates a menu.
 * Basically a menu is just a structured
 * list of anchors. This menu may have conditional sub items. The
 * goal is to support disabled or invisible entries according to the user
 * level of authorization.
 *
 * This class translate a data structure describing a menu into HTML
 */
class Menu {
	protected $CI;

	/**
	 * Constructor
	 */
	public function __construct($attrs = array ()) {
		$this->CI = & get_instance ();
		$this->CI->load->language("application");
	}

	/**
	 * Check if the menu should be displayed for the current user
	 *
	 * @param string $role
	 * @return boolean
	 */
	protected function has_privilege($role = "") {

//		DX_AUTH implementation (deprecated)
// 		if ($this->CI->dx_auth->is_admin ()) {
// 			return true;
// 		}
// 		// Not admin and privilege required
// 		if ($role) {
// 			// Et qu'on ne l'a pas
// 			if (! $this->CI->dx_auth->is_logged_in ()) {
// 				return false;
// 			}
// 			if ($this->CI->dx_auth->is_role ( $role, true, true )) {
// 				return true;
// 			}
// 		}
		return true;
	}

	/**
	 * Génération d'un menu en HTML
	 *
	 * @param unknown_type $menu
	 */
// 	public function html($menu, $level = 0, $li = false, $button_class = "") {
// 		$ul_attr = 'data-role="listview" data-divider-theme="b" data-inset="true"';
// 		$li_attr = 'data-theme="c"';
// 		$anchor_attr = 'data-transition="slide"';

// 		$res = "";

// 		if (isset ( $menu ['role'] ) && ! $this->has_privilege ( $menu ['role'] )) {
// 			return $res;
// 		}

// 		$class = (isset ( $menu ['class'] )) ? 'class="' . $menu ['class'] . '"' : "";
// 		$href = (isset ( $menu ['url'] )) ?  $menu ['url'] : '';
// 		$label = (isset ( $menu ['label'] )) ? $menu ['label'] : '';

// 		if ($li) {
// 			$res .= "<li $class $li_attr>";
// 		}

// 		if ($href || $label) {
// 		    $res .= anchor($href, $label, "$button_class $anchor_attr");
// 		}

// 		if (isset ( $menu ['submenu'] )) {
// 			// $res .= tabs($level) . "<ul $class>\n";
// 			$res .= tabs ( $level ) . "<ul $ul_attr>\n";
// 			foreach ( $menu ['submenu'] as $elt ) {
// 				$res .= tabs ( $level );
// 				$res .= $this->html ( $elt, $level + 1, true, $button_class );
// 				$res .= "\n";
// 			}
// 			$res .= tabs ( $level ) . "</ul>\n";
// 		}

// 		if ($li)
// 			$res .= '</li>';

// 		return $res;
// 	}

	/**
	 * Generate bootstrap navbar subset at the following format:
	 *
			<ul id="main-menu" class="nav navbar-nav sm">

				<li><a href="" class="dropdown-toggle" data-toggle="dropdown">Dev <b
						class="caret"></b></a>
					<ul class="dropdown-menu multi-level">
						<li><a href="/dev/phpinfo">Phpinfo</a></li>
						<li><a href="/dev/info">Info</a></li>
					</ul></li>

				<li><a href="" class="dropdown-toggle" data-toggle="dropdown">Admin<b
						class="caret"></b></a>

					<ul class="dropdown-menu multi-level">
						<li><a href="/admin/config">Configuration</a></li>
						<li class="dropdown-submenu"><a href="" class="dropdown-toggle"
							data-toggle="dropdown">Database</a>
							<ul class="dropdown-menu">
								<li><a href="/database/backup">Backup</a></li>
								<li><a href="/database/restore">Restore</a></li>
								<li><a href="/database/migration">Migration</a></li>
								<li><a href="/database/schema">Schema</a></li>
							</ul></li>
						<li><a href="/admin/lock">Lock site</a></li>
						<li><a href="/users">Users Management</a></li>
					</ul></li>

				<li><a href="" class="dropdown-toggle" data-toggle="dropdown">CRUD <b
						class="caret"></b></a>
					<ul class="dropdown-menu multi-level">
						<li><a href="/crud/list">List</a></li>
						<li><a href="/crud/create">Create</a></li>
					</ul></li>

				<li><a href="" class="dropdown-toggle" data-toggle="dropdown">Help <b
						class="caret"></b></a>
					<ul class="dropdown-menu multi-level">
						<li><a href="/about">About</a></li>
					</ul></li>
			</ul>
	 *
	 * @param unknown $menu menu data structure
	 * @param number $level depth of the menu
	 * @param string $li
	 * @param string $button_class
	 *
	 * Structure
	 *   main menu: <ul id="main-menu" class="nav navbar-nav sm">
	 *
	 *   dropdown header:
	 *     <li>
	 *       <a href="" class="dropdown-toggle" data-toggle="dropdown">
	 *         Label
	 *         <b class="caret"></b>
	 *      </a>
	 *
	 *      <ul class="dropdown-menu multi-level">
	 *        ... list of menu buttons
	 *      </ul>
	 *
	 *   Simple menu button:
	 *      <li> <a href="..."> Label </a></li>
	 *
	 *   Submenu header
	 *      <li class="dropdown-submenu">
	 *        <a href="" class="dropdown-toggle" data-toggle="dropdown">Database</a>
	 *        <ul class="dropdown-menu">
	 *           <li> ... </li>
	 *           ...
	 *        </ul>
	 */
	public function bootstrap_html($menu, $level = 0, $li = false, $button_class = "") {

		$ul_attr = ($level == 0)
			? 'id="main-menu" class="nav navbar-nav sm"'
			: 'class="dropdown-menu multi-level"';
		$li_attr = '';
		$anchor_attr = '';

		$res = "";

		if (!$this->CI->ion_auth->logged_in ()) {
			return $res;
		}
		if (isset ( $menu ['role'] ) && ! $this->has_privilege ( $menu ['role'] )) {
			return $res;
		}

		$class = (isset ( $menu ['class'] )) ? 'class="' . $menu ['class'] . '"' : "";
		$href = (isset ( $menu ['url'] )) ?  $menu ['url'] : '';
		$label = (isset ( $menu ['label'] )) ? translation($menu ['label']) : '';
		$onclick = (isset ( $menu ['onclick'] )) ? $menu ['onclick'] : '';

		# Open element
		if ($level == 0) {
			$res .= "\n";

		} elseif ($level == 1) {
			$res .= tabs($level) . '<li>';
			if (isset($menu ['submenu'])) {
				$res .= "<a href=\"$href\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
				$res .= $label . '<b class="caret"></b>' . '</a>';
			} else {
				$res .= anchor($href, $label);
			}

		} else {  # ($level >= 1)
			if (isset($menu ['submenu'])) {
			    $res .= tabs($level) . '<li class="dropdown-submenu">';
			    $res .= "<a href=\"$href\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
				$res .= $label . '</a>';
			} else {
			    $res .= tabs($level) . '<li>';
			    $attrs = "";
			    if ($onclick) {
			    	$attrs .= " onclick=\"$onclick\"";
			    }
				$res .= anchor($href, $label, $attrs);
			}
		}

		# Sub menu
		if (isset ( $menu ['submenu'] )) {
			// $res .= tabs($level) . "<ul $class>\n";
			if (!$level) {
				$res .= "\n" . tabs ( $level) . "<ul $ul_attr>\n";
			} else {
				$res .= "\n" . tabs ( $level + 1) . "<ul $ul_attr>\n";
			}
			foreach ( $menu ['submenu'] as $elt ) {
				$res .= tabs ( $level );
				$res .= $this->bootstrap_html ( $elt, $level + 1, true, $button_class );
				$res .= "\n";
			}
			if (!$level) {
				$res .= tabs($level) . "</ul>\n";
			} else {
				$res .= tabs($level + 1) . "</ul>\n";
			}

		}

		# Close element
		if ($level != 0) {
			$res .= tabs($level) . '</li>';
		}

		return $res;

	}

}