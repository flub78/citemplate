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
<?php echo form_open("auth/login", array("class" => "form-signin"));?>

	<h1><?php echo lang('login_heading');?></h1>
	<p><?php echo lang('login_subheading');?></p>

	<p>
	<div id="infoMessage"><?php echo $message;?></div>
	</p>

  <p>
    <?php echo lang('login_identity_label', 'identity');?><br>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?><br>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit(array('id' => 'submit', 'value' => lang('login_submit_btn'), 'class' => 'btn btn-lg btn-primary btn-block' ));?></p>

	<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

<?php echo form_close();?>

