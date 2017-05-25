<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>KAMAR</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>NAMA KAMAR <?php echo form_error('NAMA_KAMAR') ?></td>
            <td><input type="text" class="form-control" name="NAMA_KAMAR" id="NAMA_KAMAR" placeholder="NAMA KAMAR" value="<?php echo $NAMA_KAMAR; ?>" />
        </td>
	    <tr><td>NO KAMAR <?php echo form_error('NO_KAMAR') ?></td>
            <td><input type="text" class="form-control" name="NO_KAMAR" id="NO_KAMAR" placeholder="NO KAMAR" value="<?php echo $NO_KAMAR; ?>" />
        </td>
	    <tr><td>KAPASITAS <?php echo form_error('KAPASITAS') ?></td>
            <td><input type="text" class="form-control" name="KAPASITAS" id="KAPASITAS" placeholder="KAPASITAS" value="<?php echo $KAPASITAS; ?>" />
        </td>
	    <tr><td>STATUS KAMAR <?php echo form_error('STATUS_KAMAR') ?></td>
            <td><input type="text" class="form-control" name="STATUS_KAMAR" id="STATUS_KAMAR" placeholder="STATUS KAMAR" value="<?php echo $STATUS_KAMAR; ?>" />
        </td>
	    <input type="hidden" name="ID_KAMAR" value="<?php echo $ID_KAMAR; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kamar') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->