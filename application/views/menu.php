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
		'label' => translation ( "File" ),
		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => translation ( "New" ),
						'url' => controller_url ( "file/new" ) 
				),
				array (
						'label' => translation ( "Open" ),
						'url' => controller_url ( "file/open" ),
						'role' => 'ca' 
				),
				array (
						'label' => translation ( "Close" ),
						'url' => controller_url ( "file/close" ) 
				),
				array (
						'label' => translation ( "Save" ),
						'url' => controller_url ( "file/save" ) 
				),
				array (
						'label' => translation ( "Save as ..." ),
						'url' => controller_url ( "file/save_as" ),
						'role' => 'ca' 
				) 
		) 
);

// #################################################################################################
$menu_dev = array (
		'label' => translation ( "Dev" ),
		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => translation ( "info" ),
						'url' => controller_url ( "dev/info" )
				),
				array (
						'label' => translation ( "PhpInfo" ),
						'url' => controller_url ( "dev/phpinfo" )
				)
		)
);

// #################################################################################################

$menu_database = array (
		'label' => translation ( "Database" ),
		'class' => 'dropdown-menu multi-level',
		'submenu' => array (
				array (
						'label' => translation ( "Backup" ),
						'url' => controller_url ( "database/backup" )
				),
				array (
						'label' => translation ( "Restore" ),
						'url' => controller_url ( "database/restore" )
				),
				array (
						'label' => translation ( "Migration" ),
						'url' => controller_url ( "database/migration" )
				)
		)				
);

$menu_admin = array (
		'label' => translation ( "Admin" ),
		'class' => 'dropdown-menu multi-level',
		'role' => 'admin',
		'submenu' => array (
				array (
						'label' => translation ( "Config" ),
						'url' => controller_url ( "admin/config" )
				),
				$menu_database,
				array (
						'label' => translation ( "Lock" ),
						'url' => controller_url ( "admin/lock" )
				)
		)
);

// #################################################################################################
$menu_crud = array (
		'label' => translation ( "CRUD" ),
		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => translation ( "List" ),
						'url' => controller_url ( "crud/all" ) 
				),
				array (
						'label' => translation ( "Create" ),
						'url' => controller_url ( "crud/create" ) 
				),
				array (
						'label' => translation ( "Stats" ),
						'url' => controller_url ( "crud/stats" ) 
				)
		) 
);

$menu_help = array (
		'label' => translation ( "Help" ),
		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => translation ( "About" ),
						'url' => controller_url ( "welcome/about" ) 
				)
		) 
);

$menubar = array ('class' => 'menubar',
		'submenu' => array($menu_file, $menu_admin, $menu_dev, $menu_crud, $menu_help) 
);


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

			<?php echo bootstrap_menu($menubar); ?>
			
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

