
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Kamar Read</h3>
        <table class="table table-bordered">
	    <tr><td>NAMA KAMAR</td><td><?php echo $NAMA_KAMAR; ?></td></tr>
	    <tr><td>NO KAMAR</td><td><?php echo $NO_KAMAR; ?></td></tr>
	    <tr><td>KAPASITAS</td><td><?php echo $KAPASITAS; ?></td></tr>
	    <tr><td>STATUS KAMAR</td><td><?php echo $STATUS_KAMAR; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kamar') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->