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
 * Formulaire de ...
 * @package vues
 */

?>
<!DOCTYPE html>
<html lang="<?= translation("html_language") ?>">
<head>
	<title><?= translation("app_title");?> </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <!-- Bootstrap core CSS -->
	<?= link_tag(bootstrap_css('bootstrap.min'));?>
	<?= link_tag(bootstrap_css('bootstrap-theme'));?>
    <!-- Latest compiled and minified CSS -->

    <!-- Custom styles for this template -->
    <?= link_tag(bootstrap_css('sticky-footer-navbar'));?>
    <?= link_tag(project_css('jquery-ui-timepicker-addon'));?>
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../bootstrap/js/ie-emulation-modes-warning.js"></script>
    <?= script(bootstrap_js('ie-emulation-modes-warning'));?>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?= link_tag(bootstrap_css('dashboard'));?>
	<?= link_tag(bootstrap_css('menu'));?>
	<?= link_tag(base_url() . 'components/DataTables/datatables.css');?>
	<?= link_tag(base_url() . 'components/DataTables/DataTables-1.10.9/css/dataTables.bootstrap.css');?>

	<?= link_tag(base_url() . 'components/jquery-ui/jquery-ui.min.css');?>
	<?= link_tag(base_url() . 'components/jquery-ui/jquery-ui.structure.min.css');?>
	<?= link_tag(base_url() . 'components/jquery-ui/jquery-ui.theme.min.css');?>
	
	<?php
	// todo: manage themes. Currently the Jquery-UI theme is only used for DatePickers
	$theme = 'south-street';
	$theme = 'base';
	echo link_tag('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/' . $theme .'/jquery-ui.css');?>
	
	<?php echo link_tag(project_css('project'));
// 	$lang = $this->config->item('language');
// 	if ($lang == "french") {
// 		# echo link_tag(project_css('jquery.ui.datepicker-fr'));				
// 	} elseif ($lang == "dutch") {
// 		# echo link_tag(project_css('jquery.ui.datepicker-nl'));
// 	}
	
	?>
	
	
    