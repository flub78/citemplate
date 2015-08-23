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
 * Formulaire de ...
 * @package vues
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('header', array('title' => 'Starter Template for Bootstrap')); ?>
</head>

<body>

	<?php $this->load->view('menu'); ?>
	<div class="container">

		<div class="starter-template">
			<h1>Bootstrap starter template</h1>
			<p class="lead">
				Use this document as a way to quickly start any new project.<br> All
				you get is this text and a mostly barebones HTML document.
			</p>
		</div>
		<?php 
		echo "base_url=" . base_url() . br();
		echo "site_url=" . site_url() . br();
		echo "current_url=" . current_url() . br();
		echo "bootstrap_js=" . bootstrap_js("bootstrap") . br();
		?>
	</div>
	<!-- /.container -->

	<?php $this->load->view('footer'); ?>
</body>
</html>
