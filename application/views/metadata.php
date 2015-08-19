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
$this->lang->load('application');

$this->load->view('header', array('title' => translation('app_title')));
$this->load->view('banner');
$this->load->view('sidebar');
$this->load->view('menu');

?>
<div id="container">
	<h1><?php title('app_title'); ?></h1>

	<div id="body">
		<p>Constante: <?php echo "constant";?></p>
		<p>Variable: <?php echo $titi;?></p>
		<p>HTML variable: <?php echo $html;?></p>
		<p>Hello: <?php echo $hello?></p>
		<p>Function call: <?= translation('monde');?></p>
		
		<p>Object method call: <?= $livre1->image();?></p>
		<p>Object method call: <?php $livre2->display();$livre2->display();?></p>
	
	<table>	
	<?php foreach ($hash as $key => $value) { ?>
	    <tr>
	    <td><?php echo $key; ?></td>
	    <td><?php echo $value; ?></td>
	    </tr>
	<?php } ?>
	</table>
		
	</div>
<?php  $this->load->view('footer');?>
</div>

</body>
</html>