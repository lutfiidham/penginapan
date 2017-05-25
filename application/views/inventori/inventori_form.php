<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>INVENTORI</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>NAMA INVENTORI <?php echo form_error('NAMA_INVENTORI') ?></td>
            <td><input type="text" class="form-control" name="NAMA_INVENTORI" id="NAMA_INVENTORI" placeholder="NAMA INVENTORI" value="<?php echo $NAMA_INVENTORI; ?>" />
        </td>
	    <tr><td>HARGA INVENTORI <?php echo form_error('HARGA_INVENTORI') ?></td>
            <td><input type="text" class="form-control" name="HARGA_INVENTORI" id="HARGA_INVENTORI" placeholder="HARGA INVENTORI" value="<?php echo $HARGA_INVENTORI; ?>" />
        </td>
	    <input type="hidden" name="ID_INVENTORI" value="<?php echo $ID_INVENTORI; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('inventori') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->