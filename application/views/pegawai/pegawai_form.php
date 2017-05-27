<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>PEGAWAI</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Nama Pegawai <?php echo form_error('nama_pegawai') ?></td>
            <td><input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai" value="<?php echo $nama_pegawai; ?>" />
        </td>
	    <tr><td>Alamat Pegawai <?php echo form_error('alamat_pegawai') ?></td>
            <td><input type="text" class="form-control" name="alamat_pegawai" id="alamat_pegawai" placeholder="Alamat Pegawai" value="<?php echo $alamat_pegawai; ?>" />
        </td>
	    <tr><td>Telp Pegawai <?php echo form_error('telp_pegawai') ?></td>
            <td><input type="number" class="form-control" name="telp_pegawai" id="telp_pegawai" placeholder="Telp Pegawai" value="<?php echo $telp_pegawai; ?>" />
        </td>
	    <tr><td>Jabatan Id <?php echo form_error('jabatan_id') ?></td>
            <td>
            <?php echo cmb_dinamis('jabatan_id', 'jabatan', 'nama_jabatan', 'id_jabatan', $jabatan_id) ?>
        </td>
	    <tr><td>Status Pegawai <?php echo form_error('status_pegawai') ?></td>
                            <td><?php echo form_dropdown('status_pegawai',array('1'=>'AKTIF','0'=>'TIDAK AKTIF'),$status_pegawai,"class='form-control'");?>
        </td>
	    <input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pegawai') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->