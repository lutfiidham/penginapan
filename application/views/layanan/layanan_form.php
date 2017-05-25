<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>LAYANAN</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>NAMA LAYANAN <?php echo form_error('NAMA_LAYANAN') ?></td>
            <td><input type="text" class="form-control" name="NAMA_LAYANAN" id="NAMA_LAYANAN" placeholder="NAMA LAYANAN" value="<?php echo $NAMA_LAYANAN; ?>" />
        </td>
	    <input type="hidden" name="ID_LAYANAN" value="<?php echo $ID_LAYANAN; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('layanan') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->