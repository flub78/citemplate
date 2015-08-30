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
				<h1>About CITemplate</h1>

				<div class="row">
					<article class="col-sm-12 row">
						<div class="jumbotron">
							<p> CiTemplate is a kick start project for WEB applications based on CodeIgniter 3.x.
							 It will support all the features that you need most of the time before to start a WEB app
							 project.
							</p>
							<p>It is based on the autentication module of CIAUT. But I do not intend to use their template module, 
							nor their menu management system. Their menu management system does not support yet 
							privilege dependent accesses and I do not need to have menu modified interactively. Instead I have
							a very detailled and clean menu description in the menu view.
							</p>
							<p>There is support for:</p>
							<ul class="list-group">
								<li class="list-group-item">Menu description not embeded in the views</li>
								<li class="list-group-item">Bootstrap 3.0 views ,that'll make the application tablet  or smartphone friendly.</li>
								<li class="list-group-item">Refined Authentication by user,
									group, and granted permissions</li>
								<li class="list-group-item">Database backup, restore and migrations</li>
								<li class="list-group-item">Full internationalisation</li>
								<li class="list-group-item">Framework for PHPUnit and WATIR tests. Continuous integration with Jenkins.</li>
								<li class="list-group-item">Forms generation and data access simplified by intensive usage of metadata.</li>
							</ul>
							<p>CITemplate is a work in progress. It should advance fast as most of its features were already supported in 
							another CodeIgniter 2.0 project.
							</p>
						</div>

					</article>
				</div>
			</section>
		</div>

	</div>
	<footer class="row">
		<?php $this->load->view('footer'); ?>
	</footer>
	<!-- /.container -->

</body>
</html>
