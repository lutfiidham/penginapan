<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>PROMO</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>PROMO AWAL <?php echo form_error('PROMO_AWAL') ?></td>
            <td><input type="text" class="form-control" name="PROMO_AWAL" id="PROMO_AWAL" placeholder="PROMO AWAL" value="<?php echo $PROMO_AWAL; ?>" />
        </td>
	    <tr><td>PROMO AKHIR <?php echo form_error('PROMO_AKHIR') ?></td>
            <td><input type="text" class="form-control" name="PROMO_AKHIR" id="PROMO_AKHIR" placeholder="PROMO AKHIR" value="<?php echo $PROMO_AKHIR; ?>" />
        </td>
	    <tr><td>HARGA PROMO <?php echo form_error('HARGA_PROMO') ?></td>
            <td><input type="text" class="form-control" name="HARGA_PROMO" id="HARGA_PROMO" placeholder="HARGA PROMO" value="<?php echo $HARGA_PROMO; ?>" />
        </td>
	    <tr><td>KETERANGAN PROMO <?php echo form_error('KETERANGAN_PROMO') ?></td>
            <td><input type="text" class="form-control" name="KETERANGAN_PROMO" id="KETERANGAN_PROMO" placeholder="KETERANGAN PROMO" value="<?php echo $KETERANGAN_PROMO; ?>" />
        </td>
	    <input type="hidden" name="ID_PROMO" value="<?php echo $ID_PROMO; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('promo') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->