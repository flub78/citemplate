<?php
/**
 *    Project {$PROJECT]
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
 * Menu
 * @package vues
 * 
 * Menus are rendered hierachical list of anchors
 * - the tree must be determine from the contex: current user, page and privileges
 * - it must be rendered in HTML
 * - every level must be decorated depending on the framework used for rendering (bootstrap, etc).
 * 
 * a menu element has
 *   a label
 *   an url to call
 *   a role that determine if this element is visible depending on the user
 *   eventually a submenu, which is a list of menu elements.
 *   a class fo the element
 */

// #################################################################################################
$menu_file = array (
		'label' => translation ( "menu_file" ),
		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => translation ( "menu_new" ),
						'url' => controller_url ( "file/new" ) 
				),
				array (
						'label' => translation ( "menu_open" ),
						'url' => controller_url ( "file/open" ),
						'role' => 'ca' 
				),
				array (
						'label' => translation ( "menu_close" ),
						'url' => controller_url ( "file/close" ) 
				),
				array (
						'label' => translation ( "menu_save" ),
						'url' => controller_url ( "file/save" ) 
				),
				array (
						'label' => translation ( "menu_save_as" ),
						'url' => controller_url ( "file/save_as" ),
						'role' => 'ca' 
				) 
		) 
);

// #################################################################################################
$menu_crud = array (
		'label' => translation ( "menu_crud" ),
		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => translation ( "menu_list" ),
						'url' => controller_url ( "event/stats" ) 
				),
				array (
						'label' => translation ( "menu_create" ),
						'url' => controller_url ( "event/formation" ) 
				),
				array (
						'label' => translation ( "menu_stats" ),
						'url' => controller_url ( "event/fai" ) 
				),
				array (
						'label' => translation ( "gvv_menu_formation_pilote" ),
						'url' => controller_url ( "vols_planeur/par_pilote_machine" ),
						'role' => 'ca' 
				) 
		) 
);

$menu_help = array (
		'label' => translation ( "menu_help" ),
		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => translation ( "menu_about" ),
						'url' => controller_url ( "vols_planeur/statistic" ) 
				),
				array (
						'label' => translation ( "gvv_menu_statistic_yearly" ),
						'url' => controller_url ( "vols_planeur/cumuls" ) 
				),
				array (
						'label' => translation ( "gvv_menu_statistic_history" ),
						'url' => controller_url ( "vols_planeur/histo" ) 
				),
				array (
						'label' => translation ( "gvv_menu_statistic_age" ),
						'url' => controller_url ( "vols_planeur/age" ) 
				) 
		) 
);

$menubar = array ('class' => 'menubar',
		'submenu' => array($menu_file, $menu_crud, $menu_help) 
);

// <!-- Fixed navbar -->
// <nav class="navbar navbar-inverse navbar-fixed-top">
// <div class="container">
// <div class="navbar-header">
// <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
// <span class="sr-only">Toggle navigation</span>
// <span class="icon-bar"></span>
// </button>
// <a class="navbar-brand" href="#">CITemplate</a>
// </div>

// <div id="navbar" class="collapse navbar-collapse">
// <ul class="nav navbar-nav">
// <li class="active"><a href="#">Home</a></li>
// <li><a href="#about">About</a></li>
// <li><a href="#contact">Contact</a></li>

// <li class="dropdown">
// <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
// <ul class="dropdown-menu">
// <li><a href="#">Action</a></li>
// <li><a href="#">Another action</a></li>
// <li><a href="#">Something else here</a></li>
// <li role="separator" class="divider"></li>
// <li class="dropdown-header">Nav header</li>
// <li><a href="#">Separated link</a></li>
// <li><a href="#">One more separated link</a></li>
// </ul>
// </li>

// </ul>
// </div><!--/.nav-collapse -->
// </div>
// </nav>

?>


<nav class="navbar navbar-inverse navbar-fixed-top">

	<div class="container-fluid">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar" aria-expanded="false"
				aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">CIAUTH</a>
		</div>

		<div id="navbar" class="collapse navbar-collapse">

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
								<li><a href="/database/default">Default tables</a></li>
							</ul></li>
						<li><a href="/admin/lock">Lock site</a></li>
						<li><a href="/users">Users Management</a></li>
						<li><a href="/C_ciauth_admin/nav_admin">Menus</a></li>
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

			<ul id="main-menu" class="nav navbar-nav navbar-right">
            <?php
			  if ($this->ciauth->is_logged_in ()) {
				$userdata = $this->ciauth->get_user_data ();
				echo "<li class=\"nav-welcome\"><h5>Welcome " . $userdata->username . "</h5></li>";
				echo "<li>&nbsp;</li>";
				echo "<li><a href=\"logout\">Logout</a></li>";
 			  } else {
				echo "<li><a href=\"login\">Login</a></li>";
				echo "<li><a href=\"register\">Register</a></li>";
			  }
			?>
                        
            </ul>
		</div>
		<!--container-fluid -->

	</div>
	<!-- container-fluid -->
</nav>

