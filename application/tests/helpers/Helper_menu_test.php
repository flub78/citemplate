<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 *
 */

class Helper_menu_test extends TestCase
{
	public function setUp()
	{
		$this->resetInstance();
		$this->CI->load->library("Menu");
		$this->CI->load->library("Ion_auth");
		$this->CI->load->helper('metadata');
		$this->CI->load->helper('menu');
	}

	/**
	 * Test legacy menus
	 */
// 	public function test_html()
// 	{
// 		$this->assertEquals(1, 1, 'Menu helper is loaded');

// 		// #################################################################################################
// 		$menu_file = array (
// 				'label' => translation ( "menu_file" ),
// 				'class' => 'menuheader',
// 				'submenu' => array (
// 						array (
// 								'label' => translation ( "menu_new" ),
// 								'url' => controller_url ( "file/new" )
// 						),
// 						array (
// 								'label' => translation ( "menu_open" ),
// 								'url' => controller_url ( "file/open" ),
// 								'role' => 'ca'
// 						),
// 						array (
// 								'label' => translation ( "menu_close" ),
// 								'url' => controller_url ( "file/close" )
// 						),
// 						array (
// 								'label' => translation ( "menu_save" ),
// 								'url' => controller_url ( "file/save" )
// 						),
// 						array (
// 								'label' => translation ( "menu_save_as" ),
// 								'url' => controller_url ( "file/save_as" ),
// 								'role' => 'ca'
// 						)
// 				)
// 		);

// 		// #################################################################################################
// 		$menu_crud = array (
// 				'label' => translation ( "menu_crud" ),
// 				'class' => 'menuheader',
// 				'submenu' => array (
// 						array (
// 								'label' => translation ( "menu_list" ),
// 								'url' => controller_url ( "event/stats" )
// 						),
// 						array (
// 								'label' => translation ( "menu_create" ),
// 								'url' => controller_url ( "event/formation" )
// 						),
// 						array (
// 								'label' => translation ( "menu_stats" ),
// 								'url' => controller_url ( "event/fai" )
// 						),
// 						array (
// 								'label' => translation ( "gvv_menu_formation_pilote" ),
// 								'url' => controller_url ( "vols_planeur/par_pilote_machine" ),
// 								'role' => 'ca'
// 						)
// 				)
// 		);

// 		$menu_help = array (
// 				'label' => translation ( "menu_help" ),
// 				'class' => 'menuheader',
// 				'submenu' => array (
// 						array (
// 								'label' => translation ( "menu_about" ),
// 								'url' => controller_url ( "vols_planeur/statistic" )
// 						),
// 						array (
// 								'label' => translation ( "gvv_menu_statistic_yearly" ),
// 								'url' => controller_url ( "vols_planeur/cumuls" )
// 						),
// 						array (
// 								'label' => translation ( "gvv_menu_statistic_history" ),
// 								'url' => controller_url ( "vols_planeur/histo" )
// 						),
// 						array (
// 								'label' => translation ( "gvv_menu_statistic_age" ),
// 								'url' => controller_url ( "vols_planeur/age" )
// 						)
// 				)
// 		);

// 		$menubar = array ('class' => 'menubar',
// 				'submenu' => array($menu_file, $menu_crud, $menu_help)
// 		);

// 		$expected = '<ul data-role="listview" data-divider-theme="b" data-inset="true">
// 		<li class="menuheader" data-theme="c"><a href="http://localhost/citemplate/index.php" class="jbutton" data-transition="slide">menu_file</a>    <ul data-role="listview" data-divider-theme="b" data-inset="true">
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/file/new" class="jbutton" data-transition="slide">menu_new</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/file/open" class="jbutton" data-transition="slide">menu_open</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/file/close" class="jbutton" data-transition="slide">menu_close</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/file/save" class="jbutton" data-transition="slide">menu_save</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/file/save_as" class="jbutton" data-transition="slide">menu_save_as</a></li>
// 		</ul>
// 		</li>
// 		<li class="menuheader" data-theme="c"><a href="http://localhost/citemplate/index.php" class="jbutton" data-transition="slide">menu_crud</a>    <ul data-role="listview" data-divider-theme="b" data-inset="true">
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/event/stats" class="jbutton" data-transition="slide">menu_list</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/event/formation" class="jbutton" data-transition="slide">menu_create</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/event/fai" class="jbutton" data-transition="slide">menu_stats</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/vols_planeur/par_pilote_machine" class="jbutton" data-transition="slide">gvv_menu_formation_pilote</a></li>
// 		</ul>
// 		</li>
// 		<li class="menuheader" data-theme="c"><a href="http://localhost/citemplate/index.php" class="jbutton" data-transition="slide">menu_help</a>    <ul data-role="listview" data-divider-theme="b" data-inset="true">
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/vols_planeur/statistic" class="jbutton" data-transition="slide">menu_about</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/vols_planeur/cumuls" class="jbutton" data-transition="slide">gvv_menu_statistic_yearly</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/vols_planeur/histo" class="jbutton" data-transition="slide">gvv_menu_statistic_history</a></li>
// 		<li  data-theme="c"><a href="http://localhost/citemplate/index.php/vols_planeur/age" class="jbutton" data-transition="slide">gvv_menu_statistic_age</a></li>
// 		</ul>
// 		</li>
// 		</ul>';

// 		$html = html_menu($menubar);
// 		// echo $html;
// 		$this->assertNotEquals("", $html, 'Menu Html');
// 	}


	/**
	 * Test Bootstrap menus
	 */
	public function test_bootstrap()
	{

		// #################################################################################################
		$menu_file = array (
				'label' => translation ( "menu_file" ),
				'class' => 'dropdown-menu multi-level',
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

		$menu_database = array (
				'label' => translation ( "menu_database" ),
				'class' => 'dropdown-menu multi-level',
				'submenu' => array (
						array (
								'label' => translation ( "menu_database_backup" ),
								'url' => controller_url ( "database/backup" )
						),
						array (
								'label' => translation ( "menu_database_restore" ),
								'url' => controller_url ( "database/restore" ),
								'role' => 'ca'
						),
						array (
								'label' => translation ( "menu_database_migration" ),
								'url' => controller_url ( "database/migration" )
						)				)
		);

		$menu_admin = array (
				'label' => translation ( "menu_admin" ),
				'class' => 'dropdown-menu multi-level',
				'role' => 'admin',
				'submenu' => array (
						array (
								'label' => translation ( "menu_config" ),
								'url' => controller_url ( "admin/config" )
						),
						$menu_database,
						array (
								'label' => translation ( "menu_lock" ),
								'url' => controller_url ( "admin/lock" )
						)
				)
		);

		// #################################################################################################
		$menu_crud = array (
				'label' => translation ( "menu_crud" ),
				'class' => 'dropdown-menu multi-level',
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
				'class' => 'dropdown-menu multi-level',
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

		$menubar = array (
				'submenu' => array($menu_file, $menu_admin, $menu_crud, $menu_help)
		);

		# a User needs to be logged in to get a menu
		$this->CI->ion_auth->login('admin', 'admin', true);

		$bootstrap = bootstrap_menu($menubar);
		# echo "bootstrap menu = " . $bootstrap;
		$this->assertNotEquals("", $bootstrap, 'Bootstrap Html');
	}

}
