
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>M_KEGIATAN LIST <?php echo $this->session->userdata('level'); ?>
				  <?php 
					$level = $this->session->userdata('level');
					if($level <> 'members'){ ?>
						<?php echo anchor('m_kegiatan/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
						<?php echo anchor(site_url('m_kegiatan/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
						<?php echo anchor(site_url('m_kegiatan/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?>
						<?php echo anchor(site_url('m_kegiatan/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?></h3>
						  
					<?php 
					}
				  ?>
		      </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Kegiatan</th>
		    <th>Keterangan</th>
		    <th>Aktif</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($m_kegiatan_data as $m_kegiatan)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $m_kegiatan->nama_kegiatan ?></td>
		    <td><?php echo $m_kegiatan->keterangan ?></td>
		    <td><?php echo $m_kegiatan->aktif ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			if($level <> 'members'){ 
			echo anchor(site_url('m_kegiatan/read/'.$m_kegiatan->id_kegiatan),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('m_kegiatan/update/'.$m_kegiatan->id_kegiatan),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('m_kegiatan/delete/'.$m_kegiatan->id_kegiatan),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			}else{
				echo anchor(site_url('m_kegiatan/read/'.$m_kegiatan->id_kegiatan),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
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
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->