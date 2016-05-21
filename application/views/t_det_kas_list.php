
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'><b>List Keuangan</b>
					  <?php 
							$level = $this->session->userdata('level');
							if($level <> 'members'){ ?>
					<?php echo anchor('t_det_kas/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
					<?php echo anchor(site_url('t_det_kas/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
					<?php echo anchor(site_url('t_det_kas/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?>
					<?php echo anchor(site_url('t_det_kas/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?></h3>
					<?php }?>
                </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="example2">
            <thead>
                <tr>
            <th width="15px">No</th>
		    <th>Kwitansi</th>
		    <th>Kegiatan</th>
			<th>Tanggal</th>
			<th>Keterangan</th>
		    <th>Pengeluaran</th>
		    <th>Pemasukan</th>
		    <th>Saldo</th>
			<?php
				if($this->session->userdata('level') == 'Super Admin'){ ?>
				<th>Aktif</th>	
				<?php }
			?>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($t_det_kas_data as $t_det_kas)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $t_det_kas->no_kwitansi ?></td>
		    <td><?php echo $t_det_kas->nama_kegiatan ?></td>
			<td><?php echo $t_det_kas->tanggal ?></td>
			<td><?php echo $t_det_kas->keterangan ?></td>
		    <td><?php echo $t_det_kas->pengeluaran ?></td>
		    <td><?php echo $t_det_kas->pemasukan ?></td>
		    <td><?php echo $t_det_kas->saldo_akhir ?></td>
			<?php
				if($this->session->userdata('level') == 'Super Admin'){ ?>
				<td><?php echo $t_det_kas->aktif ?></td>
				<?php }
			?>
		    <td style="text-align:center" width="140px">
			<?php 
			$level = $this->session->userdata('level');
							if($level <> 'members'){
			echo anchor(site_url('t_det_kas/read/'.$t_det_kas->id_kas),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('t_det_kas/update/'.$t_det_kas->id_kas),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('t_det_kas/delete/'.$t_det_kas->id_kas),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				}else{
			echo anchor(site_url('t_det_kas/read/'.$t_det_kas->id_kas),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
				}
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
					<div class="box-body" style="font-size:24px;">
					<marquee><?php echo "Perolehan Terakhir Kas Remaja Masjid Tanggal"." ".date('Y-m-d H:i:s')." "." adalah ".$saldo_akhir ; ?></marquee>
					</div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->