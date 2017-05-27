
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>PEGAWAI LIST <?php echo anchor('pegawai/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('pegawai/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
		<?php echo anchor(site_url('pegawai/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Pegawai</th>
		    <th>Alamat Pegawai</th>
		    <th>Telp Pegawai</th>
		    <th>Jabatan</th>
		    <th>Status Pegawai</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;

            foreach ($pegawai_data as $pegawai)
            {

            $status_pegawai = $pegawai->status_pegawai==1?'AKTIF':'TIDAK AKTIF';
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $pegawai->nama_pegawai ?></td>
		    <td><?php echo $pegawai->alamat_pegawai ?></td>
		    <td><?php echo $pegawai->telp_pegawai ?></td>
		    <td><?php echo $pegawai->nama_jabatan ?></td>
		    <td><?php echo $status_pegawai ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('pegawai/read/'.$pegawai->id_pegawai),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('pegawai/update/'.$pegawai->id_pegawai),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('pegawai/delete/'.$pegawai->id_pegawai),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->