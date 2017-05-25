<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>JABATAN</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>NAMA JABATAN <?php echo form_error('NAMA_JABATAN') ?></td>
            <td><input type="text" class="form-control" name="NAMA_JABATAN" id="NAMA_JABATAN" placeholder="NAMA JABATAN" value="<?php echo $NAMA_JABATAN; ?>" />
        </td>
	    <input type="hidden" name="ID_JABATAN" value="<?php echo $ID_JABATAN; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jabatan') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->