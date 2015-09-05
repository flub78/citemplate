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
				<h1>Bienvenue sur CITemplate</h1>

				<div class="row">
					<article class="col-sm-12 row">
						<div class="jumbotron">
							<p> CiTemplate est une structure CodeIgniter 3.x d'application WEB.
							</p>
							<p>Elle supporte:</p>
							<ul class="list-group">
								<li class="list-group-item">Des descriptions de menus séparés des vues</li>
								<li class="list-group-item">Des vues Bootstrap 3.0,that'll pour les tablettes et les smartphones.</li>
								<li class="list-group-item">Identification des utilisateurs et droits par groupes et utilisateurs.</li>
								<li class="list-group-item">Sauvegarde, restauration et migration de la base de données.</li>
								<li class="list-group-item">Internationalisation complète.</li>
								<li class="list-group-item">Tests PHPUnit et WATIR. Intégration continue avec.</li>
								<li class="list-group-item">Utilisation des metadonnées pour générer les formulaires et simplifier l'accès aux données..</li>
							</ul>
							
						</div>

					</article>
				</div>
			</section>
		</div>

	</div>
		<?php $this->load->view('footer'); ?>
	<!-- /.container -->

</body>
</html>
