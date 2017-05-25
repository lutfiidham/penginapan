<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>DETIL_INVENTORI</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Kamar Id <?php echo form_error('kamar_id') ?></td>
            <td><input type="text" class="form-control" name="kamar_id" id="kamar_id" placeholder="Kamar Id" value="<?php echo $kamar_id; ?>" />
        </td>
	    <tr><td>Inventori Id <?php echo form_error('inventori_id') ?></td>
            <td><input type="text" class="form-control" name="inventori_id" id="inventori_id" placeholder="Inventori Id" value="<?php echo $inventori_id; ?>" />
        </td>
	    <input type="hidden" name="id_detil_inventori" value="<?php echo $id_detil_inventori; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detil_inventori') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->