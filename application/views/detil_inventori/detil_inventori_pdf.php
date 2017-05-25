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
        <h2>Detil_inventori List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>KAMAR ID</th>
		<th>INVENTORI ID</th>
		
            </tr><?php
            foreach ($detil_inventori_data as $detil_inventori)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $detil_inventori->KAMAR_ID ?></td>
		      <td><?php echo $detil_inventori->INVENTORI_ID ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>