<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>FASILITAS</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>NAMA FASILITAS <?php echo form_error('NAMA_FASILITAS') ?></td>
            <td><input type="text" class="form-control" name="NAMA_FASILITAS" id="NAMA_FASILITAS" placeholder="NAMA FASILITAS" value="<?php echo $NAMA_FASILITAS; ?>" />
        </td>
	    <tr><td>STATUS FASILITAS <?php echo form_error('STATUS_FASILITAS') ?></td>
            <td><input type="text" class="form-control" name="STATUS_FASILITAS" id="STATUS_FASILITAS" placeholder="STATUS FASILITAS" value="<?php echo $STATUS_FASILITAS; ?>" />
        </td>
	    <input type="hidden" name="ID_FASILITAS" value="<?php echo $ID_FASILITAS; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('fasilitas') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->