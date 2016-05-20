
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-body'>
					<div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Laporan Keuangan</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Tahun</label>
                    <select class="form-control select2" id="tahun" style="width: 30%;">
                      <option value="2015">2015</option>
					  <option value="2016" selected="selected">2016</option>
                      <option>2017</option>
                      <option>2018</option>
                      <option>2019</option>
                      <option>2020</option>
                      <option>2021</option>
                      <option>2022</option>
                    </select>
                  </div><!-- /.form-group -->
				  <button class="btn btn-success" id="btn_print" onclick="tes()" style="width: 15%;">Print</button>
				  <button class="btn btn-info" id="btn_excel" style="width: 15%;">Excel</button>

			</div>		
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
			function tes(){
					  var x = document.getElementById("tahun").selectedIndex;
					  var tahun = document.getElementsByTagName("option")[x].value;
						alert(y);
				}
            $(document).ready(function () {
                $("#mytable").dataTable();
				
            });
			
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->