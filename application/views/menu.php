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
$menu_bootstrap = array (
		'label' => "Bootstrap",
//		'class' => 'menuheader',
		'url' => controller_url ( "bootstrap" ),
		'submenu' => array (
				array (
						'label' => "Basic",
						'url' => controller_url ( "bootstrap/basic" )
				),
				array (
						'label' => "Blog",
						'url' => controller_url ( "bootstrap/blog" )
				),
				array (
						'label' => "Carousel",
						'url' => controller_url ( "bootstrap/carousel" )
				),
				array (
						'label' => "Cover",
						'url' => controller_url ( "bootstrap/cover" )
				),
				array (
						'label' => "Dashboard",
						'url' => controller_url ( "bootstrap/dashboard" )
				),
				array (
						'label' => "Grids",
						'url' => controller_url ( "bootstrap/grids" )
				),
				array (
						'label' => "jumbotron",
						'url' => controller_url ( "bootstrap/jumbotron" )
				),
				array (
						'label' => "narrow_jumbotron",
						'url' => controller_url ( "bootstrap/narrow_jumbotron" )
				),
				array (
						'label' => "sign_in",
						'url' => controller_url ( "bootstrap/sign_in" )
				),
				array (
						'label' => "sticky_footer_with_navbar",
						'url' => controller_url ( "bootstrap/sticky_footer_with_navbar" )
				),
				array (
						'label' => "Theme",
						'url' => controller_url ( "bootstrap/theme" )
				)
		)
);

// #################################################################################################
$menu_dev = array (
		'label' => "Dev",
		// 'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => "info",
						'url' => controller_url ( "dev/info" )
				),
				array (
						'label' => "PhpInfo",
						'url' => controller_url ( "dev/phpinfo" )
				),
				$menu_bootstrap,
				array (
						'label' => "CodeIgniter",
						'url' => "http://localhost/citemplate/user_guide/"
				),
				array (
						'label' => "Login",
						'url' => controller_url ( "welcome/login" )
				)
		)
);

// #################################################################################################

$menu_database = array (
		'label' => "Database",
//		'class' => 'dropdown-menu multi-level',
		'submenu' => array (
				array (
						'label' => "Backup",
						'url' => controller_url ( "database/backup" )
				),
				array (
						'label' => "Restore",
						'url' => controller_url ( "database/restore" )
				),
				array (
						'label' => "Migration",
						'url' => controller_url ( "database/migration" )
				)
		)				
);

$menu_admin = array (
		'label' => "Admin",
//		'class' => 'dropdown-menu multi-level',
		'role' => 'admin',
		'submenu' => array (
				array (
						'label' => "Config",
						'url' => controller_url ( "admin/config" )
				),
				$menu_database,
				array (
						'label' => "Lock",
						'url' => controller_url ( "admin/lock" )
				),
				array (
						'label' => "Users",
						'url' => controller_url ( "admin/users" )
				)
		)
);

// #################################################################################################
$menu_crud = array (
		'label' => "CRUD",
//		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => "List",
						'url' => controller_url ( "crud/all" ) 
				),
				array (
						'label' => "Create",
						'url' => controller_url ( "crud/create" ) 
				),
				array (
						'label' => "Stats",
						'url' => controller_url ( "crud/stats" ) 
				)
		) 
);

$menu_help = array (
		'label' => "Help",
//		'class' => 'menuheader',
		'submenu' => array (
				array (
						'label' => "About",
						'url' => controller_url ( "welcome/about" ) 
				)
		) 
);

if (ENVIRONMENT == 'development') {
	$menubar = array ('class' => 'menubar',
		'submenu' => array($menu_admin, $menu_dev, $menu_crud, $menu_help) 
	);
} else {
	$menubar = array ('class' => 'menubar',
			'submenu' => array($menu_admin, $menu_crud, $menu_help)
	);
}

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
			<a class="navbar-brand" href="#">CITemp</a>
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

