<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>PROFIL</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>NAMA <?php echo form_error('NAMA') ?></td>
            <td><input type="text" class="form-control" name="NAMA" id="NAMA" placeholder="NAMA" value="<?php echo $NAMA; ?>" />
        </td>
	    <tr><td>ALAMAT <?php echo form_error('ALAMAT') ?></td>
            <td><input type="text" class="form-control" name="ALAMAT" id="ALAMAT" placeholder="ALAMAT" value="<?php echo $ALAMAT; ?>" />
        </td>
	    <tr><td>TELP <?php echo form_error('TELP') ?></td>
            <td><input type="text" class="form-control" name="TELP" id="TELP" placeholder="TELP" value="<?php echo $TELP; ?>" />
        </td>
	    <input type="hidden" name="ID_PROFIL" value="<?php echo $ID_PROFIL; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('profil') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->