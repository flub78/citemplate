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
 
$this->load->view('header');
$this->load->language('admin');
?>
<!-- Additional view specific header elements below -->
</head>

<body>

	<div class="container-fluid starter-template">
		<header class="row">
			<div class="col-lg-12">
				<?php $this->load->view('menu'); ?>
			</div>
		</header>

		<div class="row"
			<nav class="col-sm-1"></nav>
			<section class="col-sm-11">
				<h1><?php echo isset($title) ? $title : ''; ?></h1>

				<p class="error"> <?php echo isset($error) ? $error : ''; ?></p>
				
				<div class="row">
					<article class="col-sm-12 row">
						<div class="jumbotron">
						
							<?php echo isset($message) ? $message : ''; 
							echo p(translation("admin_db_warning"), 'class="error"' );
							echo br();
							echo p(translation("admin_db_select"));
							echo form_open_multipart('databaseMgt/do_restore');
							echo '<input type="file" name="userfile" size="50" /><br><br>';
							$checked = "";
							if ($erase_db) {
								$checked = ' checked="checked" ';
							}
							echo translation("admin_db_overwrite") . ': '
									. "<input type=\"checkbox\" name=\"erase_db\" $checked value=\"$erase_db\" id=\"erase_db\"  />"
									. br(2);
							echo form_input(array('type' => 'submit', 'name' => 'button', 'value' => translation("button_validate")));
							echo form_close('</div>');					
							
							?>
							
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
