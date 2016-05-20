
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>USERS LIST <?php echo anchor('auth/create/','Create',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('auth/pdf'), '<i class="fa fa-file-pdf-o"></i> PDF', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Ip Address</th>
		    <th>Password</th>
		    <th>Salt</th>
		    <th>Email</th>
		    <th>Activation Code</th>
		    <th>Forgotten Password Code</th>
		    <th>Forgotten Password Time</th>
		    <th>Remember Code</th>
		    <th>Created On</th>
		    <th>Last Login</th>
		    <th>Active</th>
		    <th>First Name</th>
		    <th>Last Name</th>
		    <th>Company</th>
		    <th>Phone</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($auth_data as $auth)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $auth->ip_address ?></td>
		    <td><?php echo $auth->password ?></td>
		    <td><?php echo $auth->salt ?></td>
		    <td><?php echo $auth->email ?></td>
		    <td><?php echo $auth->activation_code ?></td>
		    <td><?php echo $auth->forgotten_password_code ?></td>
		    <td><?php echo $auth->forgotten_password_time ?></td>
		    <td><?php echo $auth->remember_code ?></td>
		    <td><?php echo $auth->created_on ?></td>
		    <td><?php echo $auth->last_login ?></td>
		    <td><?php echo $auth->active ?></td>
		    <td><?php echo $auth->first_name ?></td>
		    <td><?php echo $auth->last_name ?></td>
		    <td><?php echo $auth->company ?></td>
		    <td><?php echo $auth->phone ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('auth/read/'.$auth->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('auth/update/'.$auth->id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-danger btn-sm')); 
			echo '  '; 
			echo anchor(site_url('auth/delete/'.$auth->id),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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