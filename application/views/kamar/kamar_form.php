<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>KAMAR</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Nama Kamar <?php echo form_error('nama_kamar') ?></td>
            <td><input type="text" class="form-control" name="nama_kamar" id="nama_kamar" placeholder="Nama Kamar" value="<?php echo $nama_kamar; ?>" />
        </td>
	    <tr><td>No Kamar <?php echo form_error('no_kamar') ?></td>
            <td><input type="text" class="form-control" name="no_kamar" id="no_kamar" placeholder="No Kamar" value="<?php echo $no_kamar; ?>" />
        </td>
	    <tr><td>Kapasitas <?php echo form_error('kapasitas') ?></td>
            <td><input type="number" class="form-control" name="kapasitas" id="kapasitas" placeholder="Kapasitas" value="<?php echo $kapasitas; ?>" />
        </td>
	    <tr><td>Status Kamar <?php echo form_error('status_kamar') ?></td>
                            <td><?php echo form_dropdown('status_kamar',array('1'=>'AKTIF','0'=>'TIDAK AKTIF'),$status_kamar,"class='form-control'");?>
            
        </td>
	    <input type="hidden" name="id_kamar" value="<?php echo $id_kamar; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kamar') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->