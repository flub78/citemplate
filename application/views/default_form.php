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
</head>

<body>

	<div class="container-fluid starter-template">
		<header class="row">
			<div class="col-lg-12">
				<?php $this->load->view('menu'); ?>
			</div>
		</header>

		<div class="row">
			<nav class="col-sm-1"></nav>
			<section class="col-sm-11">

				<div class="row">
					<div class="col-lg-6 col-lg-offset-4 text-error">
						<p class="text-warning"><?php echo validation_errors(); ?></p>
						<p class="text-warning"><?php echo isset($error_msg) ? $error_msg : ""; ?></p>
					</div>
				</div>
				<div class="">
				<?= form_open($controller . "/validate/$action", array("class" => "form-register")); ?>

					<h2 class="form-heading"><?= isset($title) ? $title : "" ?></h2>
					<?= form($table, $field_list, $values);?>
					<div id='message'></div>
					<p>&nbsp;</p>
					<?= submit(translation($submit_label)); ?>
				<?= form_close();?>
			</div>

			</section>
		</div>

	</div>
	<footer class="row">
	<?php $this->load->view('footer'); ?>
	</footer>
	<!-- /.container -->

    <?= script(base_url() . '/js/project.js')?>

</body>
</html>
