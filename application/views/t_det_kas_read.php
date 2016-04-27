
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>T_det_kas Read</h3>
        <table class="table table-bordered">
	    <tr><td>Kegiatan</td><td><?php echo $nama_kegiatan; ?></td></tr>
		<tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
		<tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Pengeluaran</td><td><?php echo $pengeluaran; ?></td></tr>
	    <tr><td>Pemasukan</td><td><?php echo $pemasukan; ?></td></tr>
	    <tr><td>Saldo</td><td><?php echo $saldo; ?></td></tr>
	    <tr><td>Aktif</td><td><?php echo $aktif; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('t_det_kas') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->