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
 * Tutorial OpenClassroom
 * @package vues
 *
 * CSS

 .row {
 margin-right: -15px;
 margin-left: -15px;
 }

 col-[xs|sm|md|lg]-[1,2,.. ,11,12]
 xs = < 768 pixels
 sm = < 992 pixels
 md = < 1200 pixels
 lg >= 1200 pixels

 <div class="row">
 <div class="col-xs-4">Largeur 4</div>
 <div class="col-xs-8">Largeur 8</div>
 </div>

 The 12 columns are relative to the parent width. If a row has a width of 6 inside a row that spread itself
 on 50 % of the screen its width is 25%.

 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('header', array('title' => 'Starter Template for Bootstrap')); ?>
<!-- Custom styles for this template -->
<?= link_tag(bootstrap_css('tuto'));?>
</head>

<body>

	<div class="container-fluid">
		<?php $this->load->view('menu'); ?>

		<div class="starter-template">
			<h1>Bootstrap starter template</h1>
			<p class="lead">
				Use this document as a way to quickly start any new project.<br> All
				you get is this text and a mostly barebones HTML document.
			</p>
		</div>

		<div class="row">
			<div class="col-lg-6">
				6 colonnes
				<div class="row">
					<div class="col-lg-4">4 col</div>
					<div class="col-lg-4 col-lg-offset-4">4 colonnes</div>
				</div>
			</div>
			<div class="col-lg-6">
				6 colonnes
				<div class="row">
					<div class="col-lg-4">4 col</div>
					<div class="col-lg-8">8 colonnes</div>
				</div>
			</div>
		</div>
        </br>
		<header class="row">
			<div class="col-lg-12">Entete</div>
		</header>
		<div class="row">
			<nav class="col-sm-2">Menu</nav>
			<section class="col-sm-10">
				Section
				<div class="row">
					<article class="col-sm-10">Article</article>
					<div class="col-sm-2">
						<div class="row">
							<aside>Aside 1</aside>
							<aside>Aside 2</aside>
						</div>
					</div>
				</div>
			</section>
		</div>
		<footer class="row">
			<div class="col-lg-12">Pied de page</div>
		</footer>

	</div>
	<!-- /.container -->

</body>
</html>
