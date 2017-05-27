<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>FASILITAS</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Nama Fasilitas <?php echo form_error('nama_fasilitas') ?></td>
            <td><input type="text" class="form-control" name="nama_fasilitas" id="nama_fasilitas" placeholder="Nama Fasilitas" value="<?php echo $nama_fasilitas; ?>" />
        </td>
	    <tr><td>Status Fasilitas <?php echo form_error('status_fasilitas') ?></td>
                       <td><?php echo form_dropdown('status_fasilitas',array('1'=>'AKTIF','0'=>'TIDAK AKTIF'),$status_fasilitas,"class='form-control'");?>
        </td>
	    <input type="hidden" name="id_fasilitas" value="<?php echo $id_fasilitas; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('fasilitas') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->