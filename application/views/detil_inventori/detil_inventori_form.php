<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>DETIL_INVENTORI</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>KAMAR ID <?php echo form_error('KAMAR_ID') ?></td>
            <td><input type="text" class="form-control" name="KAMAR_ID" id="KAMAR_ID" placeholder="KAMAR ID" value="<?php echo $KAMAR_ID; ?>" />
        </td>
	    <tr><td>INVENTORI ID <?php echo form_error('INVENTORI_ID') ?></td>
            <td><input type="text" class="form-control" name="INVENTORI_ID" id="INVENTORI_ID" placeholder="INVENTORI ID" value="<?php echo $INVENTORI_ID; ?>" />
        </td>
	    <input type="hidden" name="ID_DETIL_INVENTORI" value="<?php echo $ID_DETIL_INVENTORI; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detil_inventori') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->