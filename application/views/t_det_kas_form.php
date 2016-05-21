<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>Form Keuangan</h3>
				  <?php 
				/* 	$hasil = 0 + (0-50000);
					echo $hasil; */
				  ?>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Kegiatan <?php echo form_error('id_kegiatan') ?></td>
            <td> <?php echo cmb_dinamis('id_kegiatan','m_kegiatan','nama_kegiatan','id_kegiatan',$id_kegiatan); ?>
        </td>
		<tr><td>Tanggal <?php echo form_error('tanggal') ?></td>
            <td><input type="date" class="form-control" name="tanggal" min="2000-01-01" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </td>
	    <tr><td>Pengeluaran <?php echo form_error('pengeluaran') ?></td>
            <td><input type="number" class="form-control"  name="pengeluaran" id="pengeluaran" placeholder="Pengeluaran" value="<?php echo $pengeluaran; ?>" />
        </td>
	    <tr><td>Pemasukan <?php echo form_error('pemasukan') ?></td>
            <td><input type="number" class="form-control" name="pemasukan" id="pemasukan" placeholder="Pemasukan" value="<?php echo $pemasukan; ?>" />
        </td>
	    <tr><td>Keterangan <?php echo form_error('keterangan') ?></td>
            <td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </td>
	    
	    <tr><td>Aktif <?php echo form_error('aktif') ?></td>
            <td><?php echo radio_aktif($aktif); ?>
        </td>
	    <input type="hidden" name="id_kas" value="<?php echo $id_kas; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('t_det_kas') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->