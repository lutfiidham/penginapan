<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>PROMO</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Promo Awal <?php echo form_error('promo_awal') ?></td>
            <td><input type="text" class="form-control" name="promo_awal" id="promo_awal" placeholder="Promo Awal" value="<?php echo $promo_awal; ?>" />
        </td>
	    <tr><td>Promo Akhir <?php echo form_error('promo_akhir') ?></td>
            <td><input type="text" class="form-control" name="promo_akhir" id="promo_akhir" placeholder="Promo Akhir" value="<?php echo $promo_akhir; ?>" />
        </td>
	    <tr><td>Harga Promo <?php echo form_error('harga_promo') ?></td>
            <td><input type="number" class="form-control" name="harga_promo" id="harga_promo" placeholder="Harga Promo" value="<?php echo $harga_promo; ?>" />
        </td>
	    <tr><td>Keterangan Promo <?php echo form_error('keterangan_promo') ?></td>
            <td><input type="text" class="form-control" name="keterangan_promo" id="keterangan_promo" placeholder="Keterangan Promo" value="<?php echo $keterangan_promo; ?>" />
        </td>
	    <input type="hidden" name="id_promo" value="<?php echo $id_promo; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('promo') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->