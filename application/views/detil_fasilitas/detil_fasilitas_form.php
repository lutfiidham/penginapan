<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>DETIL_FASILITAS</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>KAMAR ID <?php echo form_error('KAMAR_ID') ?></td>
            <td><input type="text" class="form-control" name="KAMAR_ID" id="KAMAR_ID" placeholder="KAMAR ID" value="<?php echo $KAMAR_ID; ?>" />
        </td>
	    <tr><td>FASILITAS ID <?php echo form_error('FASILITAS_ID') ?></td>
            <td><input type="text" class="form-control" name="FASILITAS_ID" id="FASILITAS_ID" placeholder="FASILITAS ID" value="<?php echo $FASILITAS_ID; ?>" />
        </td>
	    <input type="hidden" name="ID_DETAIL_FASILITAS" value="<?php echo $ID_DETAIL_FASILITAS; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detil_fasilitas') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->