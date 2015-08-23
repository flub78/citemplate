<?php
/**
 *    Project {$PROJECT]
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
 * Footer
 * @package vues
 */
?>

    <footer class="footer">
      <div class="container">
      <p class="text-muted">
        &copy Company 2014, Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
        </p>
      </div>
    </footer>



    <!-- Latest compiled and minified JavaScript -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<?= script(bootstrap_js('jquery.min'))?>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<?= script(bootstrap_js('bootstrap.min'))?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 	<?= script(bootstrap_js('ie10-viewport-bug-workaround'))?>
