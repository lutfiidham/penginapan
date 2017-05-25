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
        <h2>Kamar List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>NAMA KAMAR</th>
		<th>NO KAMAR</th>
		<th>KAPASITAS</th>
		<th>STATUS KAMAR</th>
		
            </tr><?php
            foreach ($kamar_data as $kamar)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kamar->NAMA_KAMAR ?></td>
		      <td><?php echo $kamar->NO_KAMAR ?></td>
		      <td><?php echo $kamar->KAPASITAS ?></td>
		      <td><?php echo $kamar->STATUS_KAMAR ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>