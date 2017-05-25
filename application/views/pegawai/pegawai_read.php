
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Pegawai Read</h3>
        <table class="table table-bordered">
	    <tr><td>Nama Pegawai</td><td><?php echo $nama_pegawai; ?></td></tr>
	    <tr><td>Alamat Pegawai</td><td><?php echo $alamat_pegawai; ?></td></tr>
	    <tr><td>Telp Pegawai</td><td><?php echo $telp_pegawai; ?></td></tr>
	    <tr><td>Jabatan Id</td><td><?php echo $jabatan_id; ?></td></tr>
	    <tr><td>Status Pegawai</td><td><?php echo $status_pegawai; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pegawai') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->