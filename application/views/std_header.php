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
* This view is a standard form for CRUD create and edit using bootstrap.
* @package vues
*/
?>
<?php $this->load->view('header'); ?>
<!-- Additional view specific header elements below -->
<?= link_tag(bootstrap_css('signin'));?>
<?= link_tag(project_css('project'));?>
</head>

<body>
	<?php $this->load->view('menu'); ?>

	<div class="container-fluid starter-template">

		<div class="row">
			<div class="col-lg-6 col-lg-offset-4 text-error">
				<p class="text-warning"><?php echo validation_errors(); ?></p>
				<p class="text-warning"><?php # echo $error_msg; ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-11">