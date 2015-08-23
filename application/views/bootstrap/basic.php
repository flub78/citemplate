<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('header', array('title' => 'Bootstrap 101 Template')); ?>
</head>
<body>

	<div class="container">
		<h1>Hello, world!</h1>
		<p class="lead">This is a section</p>

		<div>
			<?= anchor(controller_url("bootstrap/index"), "Bootstrap/basic"); ?>
		</div>
		<div>
			<?= anchor(controller_url("bootstrap/carousel"), "Bootstrap/carousel"); ?>
		</div>
		<div>
			<?= anchor(controller_url("bootstrap/dashboard"), "Bootstrap/dashboard"); ?>
		</div>

		<?php
		$list = array('blog', 'cover', 'fixed_navbar', 'grids', 'jumbotron', 'navbar',
				'sign_in', 'starter', 'sticky_footer_with_navbar');
		foreach ($list as $item) {
			echo '<div>' . anchor(controller_url("bootstrap/" . $item), $item) .'</div>';
		}
		?>

		... container ..
		<p class="muted">Fusce dapibus, tellus ac cursus commodo, tortor
			mauris nibh.</p>
		<p class="text-warning">Etiam porta sem malesuada magna mollis
			euismod.</p>
		<p class="text-error">Donec ullamcorper nulla non metus auctor
			fringilla.</p>
		<p class="text-info">Aenean eu leo quam. Pellentesque ornare sem
			lacinia quam venenatis.</p>
		<p class="text-success">Duis mollis, est non commodo luctus, nisi erat
			porttitor ligula.</p>

		<address>
			<strong>Twitter, Inc.</strong><br> 795 Folsom Ave, Suite 600<br> San
			Francisco, CA 94107<br> <abbr title="Phone">P:</abbr> (123) 456-7890
		</address>

		<address>
			<strong>Full Name</strong><br> <a href="mailto:#">first.last@example.com</a>
		</address>

		<div class="bs-docs-example">
			<dl class="dl-horizontal">
				<dt>Description lists</dt>
				<dd>A description list is perfect for defining terms.</dd>
				<dt>Euismod</dt>
				<dd>Vestibulum id ligula porta felis euismod semper eget lacinia
					odio sem nec elit.</dd>
				<dd>Donec id elit non mi porta gravida at eget metus.</dd>
				<dt>Malesuada porta</dt>
				<dd>Etiam porta sem malesuada magna mollis euismod.</dd>
				<dt>Felis euismod semper eget lacinia</dt>
				<dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris
					condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
			</dl>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Product</th>
					<th>Payment Taken</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<tr class="success">
					<td>1</td>
					<td>TB - Monthly</td>
					<td>01/04/2012</td>
					<td>Approved</td>
				</tr>
				<tr class="bg-danger">
					<td>2</td>
					<td>TB - Monthly</td>
					<td>02/04/2012</td>
					<td>Declined</td>
				</tr>
				<tr class="warning">
					<td>3</td>
					<td>TB - Monthly</td>
					<td>03/04/2012</td>
					<td>Pending</td>
				</tr>
				<tr class="info">
					<td>4</td>
					<td>TB - Monthly</td>
					<td>04/04/2012</td>
					<td>Call in to confirm</td>
				</tr>
			</tbody>
		</table>

		<form>
			<fieldset>
				<legend>Legend</legend>
				<label>Label name</label> <input type="text"
					placeholder="Type something…"> <span class="help-block">Example
					block-level help text here.</span> <label class="checkbox"> <input
					type="checkbox"> Check me out
				</label>
				<button type="submit" class="btn">Submit</button>
			</fieldset>
		</form>


		<div class="row">
			<div class="col-md-4">First col</div>
			<div class="col-md-3 offset2">Another col</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				Fluid 12
				<div class="row-fluid">
					<div class="span6">
						Fluid 6
						<div class="row-fluid">
							<div class="span6">Fluid 6</div>
							<div class="span6">Fluid 6</div>
						</div>
					</div>
					<div class="span6">Fluid 6</div>
				</div>
			</div>
		</div>

		<form class="form-inline">
			<input type="text" class="input-small" placeholder="Email"> <input
				type="password" class="input-small" placeholder="Password"> <label
				class="checkbox"> <input type="checkbox"> Remember me
			</label>
			<button type="submit" class="btn">Sign in</button>
		</form>


		<div class="btn-toolbar">
			<div class="btn-group">
				<a class="btn" href="#"><i class="icon-align-left"></i> </a> <a
					class="btn" href="#"><i class="icon-align-center"></i> </a> <a
					class="btn" href="#"><i class="icon-align-right"></i> </a> <a
					class="btn" href="#"><i class="icon-align-justify"></i> </a>
			</div>

			<button type="button" class="btn btn-default btn-lg"
				aria-label="Left Align">
				<span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
			</button>

			<button type="button" class="btn btn-default ">
				<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
				Star
			</button>

			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button"
					id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="true">
					Dropdown <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li><a href="#">Separated link</a></li>
				</ul>
			</div>

		</div>

		<!-- Single button -->
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
			</ul>
		</div>

	</div>
	<!-- /.container -->
	<?php $this->load->view('footer'); ?>
	
</body>
</html>
