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
				<h1>Bootstrap starter template</h1>

				<div class="row">
					<article class="col-sm-12 row">
						<p class="lead">
							Use this document as a way to quickly start any new project.<br>
							All you get is this text and a mostly barebones HTML document.
						</p>
						<p class="lead">
							Use this document as a way to quickly start any new project.<br>
							All you get is this text and a mostly barebones HTML document.
						</p>
						<?php 
						echo "base_url=" . base_url() . br();
						echo "site_url=" . site_url() . br();
						echo "current_url=" . current_url() . br();
						echo "bootstrap_js=" . bootstrap_js("bootstrap") . br();
						?>

					</article>
				</div>
			</section>
		</div>
		
	</div>
	<footer class="row">
	<?php $this->load->view('footer'); ?>
	</footer><!-- /.container -->

</body>
</html>
