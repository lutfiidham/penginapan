<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Promo List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Promo Awal</th>
		<th>Promo Akhir</th>
		<th>Harga Promo</th>
		<th>Keterangan Promo</th>
		
            </tr><?php
            foreach ($promo_data as $promo)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $promo->promo_awal ?></td>
		      <td><?php echo $promo->promo_akhir ?></td>
		      <td><?php echo $promo->harga_promo ?></td>
		      <td><?php echo $promo->keterangan_promo ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>