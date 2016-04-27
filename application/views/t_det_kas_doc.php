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
        <h2>T_det_kas List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kegiatan</th>
		<th>Pengeluaran</th>
		<th>Pemasukan</th>
		<th>Saldo</th>
		<th>Keterangan</th>
		<th>Tanggal</th>
		<th>Aktif</th>
		<th>Created Date</th>
		<th>Created By</th>
		<th>Updated Date</th>
		<th>Updated By</th>
		<th>Revised</th>
		
            </tr><?php
            foreach ($t_det_kas_data as $t_det_kas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $t_det_kas->id_kegiatan ?></td>
		      <td><?php echo $t_det_kas->pengeluaran ?></td>
		      <td><?php echo $t_det_kas->pemasukan ?></td>
		      <td><?php echo $t_det_kas->saldo ?></td>
		      <td><?php echo $t_det_kas->keterangan ?></td>
		      <td><?php echo $t_det_kas->tanggal ?></td>
		      <td><?php echo $t_det_kas->aktif ?></td>
		      <td><?php echo $t_det_kas->created_date ?></td>
		      <td><?php echo $t_det_kas->created_by ?></td>
		      <td><?php echo $t_det_kas->updated_date ?></td>
		      <td><?php echo $t_det_kas->updated_by ?></td>
		      <td><?php echo $t_det_kas->revised ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>