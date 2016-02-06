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
				<p class="text-warning"><?php echo $error_msg; ?></p>
			</div>
		</div>

		<!--   form class="form-signin" -->
		<?php echo form_open('welcome/login', array("class" => "form-signin")); ?>

			<h2 class="form-signin-heading"><?= translation('login_title'); ?></h2>

			<label for="login_value" class="sr-only"><?= translation("login_user_label");?></label>
		    <input
				type="text" id="login_value" name="login_value" class="form-control"
				placeholder="<?= translation('login_user_label'); ?>" required autofocus />
			<label
				for="password" class="sr-only"><?= translation('login_password_label'); ?></label>
			<input
				type="password" id="password" name="password" class="form-control"
				placeholder="<?= translation('login_password_label'); ?>" required />
			<div class="checkbox">
				<label> <input type="checkbox" name="keep_logged_in" value="remember-me" id="keep_logged_in"/> <?= translation('login_remember_me_label'); ?>
				</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?= translation('login_sign_in_button'); ?></button>
		</form>
	</div>
	<footer class="row">
		<?php $this->load->view('footer'); ?>
	</footer>
	<!-- /.container -->

</body>
</html>
