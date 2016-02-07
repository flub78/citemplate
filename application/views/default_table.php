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
$this->load->library ( 'table' );
?>
<?php $this->load->view('header'); ?>
<!-- Additional view specific header elements below -->
<?= link_tag(base_url() . '/components/DataTables/Buttons-1.0.3/css/buttons.dataTables.min.css');?>

</head>

<body>
    <?php // hidden contrller url for java script access
		echo form_hidden ( 'controller_url', controller_url ( $controller ));
		if (isset($server_side)) {
            echo form_hidden('server_side', $server_side);
		}
		?>

	<div class="container-fluid starter-template">
		<header class="row">
			<div class="col-lg-12">
				<?php $this->load->view('menu'); ?>
			</div>
		</header>

		<div class="row">
			<nav class="col-sm-1"></nav>
			<section class="col-sm-11">
			    <?= heading($table_title, 3); ?>

				<div class="row">
					<div class="col-lg-6 col-lg-offset-4 text-error">
						<p class="text"><?php echo isset($message) ? $message : ""; ?></p>
					</div>
				</div>
				<div class="row">
					<article class="col-sm-12 row">
						<?php
						$this->table->set_template ( array ('table_open' => '<table class="display" cellspacing="0" width="100%">') );
						echo $this->table->generate ( $data_table );
						?>
					</article>
				</div>
			</section>
		</div>

	</div>
	<footer class="row">
	<?php $this->load->view('footer'); ?>
	</footer>
	<!-- /.container -->

	<?= script(base_url() . '/components/DataTables/datatables.js')?>
	<?= script(base_url() . '/components/DataTables/Buttons-1.0.3/js/dataTables.buttons.min.js')?>
	<?= script(base_url() . '/components/DataTables/Buttons-1.0.3/js/buttons.bootstrap.min.js')?>

    <?= script('https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')?>
    <?= script('https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')?>
    <?= script('https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')?>

    <?= script(base_url() . '/components/DataTables/Buttons-1.0.3/js/buttons.html5.min.js')?>
    <?= script(base_url() . '/components/DataTables/Buttons-1.0.3/js/buttons.print.min.js')?>

<script type="text/javascript">
<!--
$(document).ready(function(){

	var server_side = $('[name="server_side"]').val();
	var ajax_url = "api/user";

	if (server_side) {
		// alert("Server side !!!");
		var table = $('.display').dataTable( {
            stateSave: true,
            dom: 'Blfrtip',
            "oLanguage": olanguage,
            "bServerSide": true,
            "ajax": {
                "url": ajax_url,
                "data": function ( d ) {
                   d.datatable = 1;
                }
            },
            buttons: [
                  'excel', 'pdf', 'print',
                  {
                      text: 'Create',
                      action: function ( e, dt, node, config ) {
                          var url = $('input[name="controller_url"]').val() + '/create';
                          window.location.href = url;
                      }
                  }
              ]
        });
	} else {

        var table = $('.display').dataTable( {
            stateSave: true,
            dom: 'Blfrtip',
            "oLanguage": olanguage,

            buttons: [
                  'excel', 'pdf', 'print',
                  {
                      text: 'Create',
                      action: function ( e, dt, node, config ) {
                          var url = $('input[name="controller_url"]').val() + '/create';
                          window.location.href = url;
                      }
                  }
              ]
        });
	}

    new $.fn.dataTable.Buttons( table, {
        buttons: [
            {
                text: 'Button 2',
                action: function ( e, dt, node, conf ) {
                    alert( 'Button 2 clicked on' );
                }
            },
            {
                text: 'Button 3',
                action: function ( e, dt, node, conf ) {
                    alert( 'Button 3 clicked on' );
                }
            }
        ]
    } );

    table.buttons( 1, null ).container().appendTo(
            table.table().container()
        );

});

//-->
</script>

</body>
</html>
