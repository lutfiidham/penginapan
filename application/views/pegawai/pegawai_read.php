
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Pegawai Read</h3>
        <table class="table table-bordered">
	    <tr><td>NAMA PEGAWAI</td><td><?php echo $NAMA_PEGAWAI; ?></td></tr>
	    <tr><td>ALAMAT PEGAWAI</td><td><?php echo $ALAMAT_PEGAWAI; ?></td></tr>
	    <tr><td>TELP PEGAWAI</td><td><?php echo $TELP_PEGAWAI; ?></td></tr>
	    <tr><td>JABATAN ID</td><td><?php echo $JABATAN_ID; ?></td></tr>
	    <tr><td>STATUS PEGAWAI</td><td><?php echo $STATUS_PEGAWAI; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pegawai') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->