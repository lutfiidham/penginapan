<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>PEGAWAI</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>NAMA PEGAWAI <?php echo form_error('NAMA_PEGAWAI') ?></td>
            <td><input type="text" class="form-control" name="NAMA_PEGAWAI" id="NAMA_PEGAWAI" placeholder="NAMA PEGAWAI" value="<?php echo $NAMA_PEGAWAI; ?>" />
        </td>
	    <tr><td>ALAMAT PEGAWAI <?php echo form_error('ALAMAT_PEGAWAI') ?></td>
            <td><input type="text" class="form-control" name="ALAMAT_PEGAWAI" id="ALAMAT_PEGAWAI" placeholder="ALAMAT PEGAWAI" value="<?php echo $ALAMAT_PEGAWAI; ?>" />
        </td>
	    <tr><td>TELP PEGAWAI <?php echo form_error('TELP_PEGAWAI') ?></td>
            <td><input type="text" class="form-control" name="TELP_PEGAWAI" id="TELP_PEGAWAI" placeholder="TELP PEGAWAI" value="<?php echo $TELP_PEGAWAI; ?>" />
        </td>
	    <tr><td>JABATAN ID <?php echo form_error('JABATAN_ID') ?></td>
            <td><input type="text" class="form-control" name="JABATAN_ID" id="JABATAN_ID" placeholder="JABATAN ID" value="<?php echo $JABATAN_ID; ?>" />
        </td>
	    <tr><td>STATUS PEGAWAI <?php echo form_error('STATUS_PEGAWAI') ?></td>
            <td><input type="text" class="form-control" name="STATUS_PEGAWAI" id="STATUS_PEGAWAI" placeholder="STATUS PEGAWAI" value="<?php echo $STATUS_PEGAWAI; ?>" />
        </td>
	    <input type="hidden" name="ID_PEGAWAI" value="<?php echo $ID_PEGAWAI; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pegawai') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->