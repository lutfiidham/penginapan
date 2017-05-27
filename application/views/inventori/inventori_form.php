<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>INVENTORI</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Nama Inventori <?php echo form_error('nama_inventori') ?></td>
            <td><input type="text" class="form-control" name="nama_inventori" id="nama_inventori" placeholder="Nama Inventori" value="<?php echo $nama_inventori; ?>" />
        </td>
	    <tr><td>Harga Inventori <?php echo form_error('harga_inventori') ?></td>
            <td><input type="number" class="form-control" name="harga_inventori" id="harga_inventori" placeholder="Harga Inventori" value="<?php echo $harga_inventori; ?>" />
        </td>
	    <input type="hidden" name="id_inventori" value="<?php echo $id_inventori; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('inventori') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->