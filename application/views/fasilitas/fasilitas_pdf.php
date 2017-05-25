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
        <h2>Fasilitas List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>NAMA FASILITAS</th>
		<th>STATUS FASILITAS</th>
		
            </tr><?php
            foreach ($fasilitas_data as $fasilitas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $fasilitas->NAMA_FASILITAS ?></td>
		      <td><?php echo $fasilitas->STATUS_FASILITAS ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>