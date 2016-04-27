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
        <h2>M_kegiatan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Kegiatan</th>
		<th>Keterangan</th>
		<th>Aktif</th>
		
            </tr><?php
            foreach ($m_kegiatan_data as $m_kegiatan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $m_kegiatan->nama_kegiatan ?></td>
		      <td><?php echo $m_kegiatan->keterangan ?></td>
		      <td><?php echo $m_kegiatan->aktif ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>