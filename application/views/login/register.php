<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>REMAS HIDAYATULLAH | Halaman Pendaftaran</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="../../index2.html"><b>Remas</b>HD</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Pendaftaran Anggota Remas HD</p>
        <form action=<?php echo base_url()."index.php/menu_login/daftar"; ?> method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" maxlength="10" title="Wajib Di isi ! Max 10 character" required placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
		   <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" required minlength="6" title="Password minimal 6 character" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
            <input type="text" class="form-control" name="nama_lengkap" maxlength="50" required placeholder="Nama Lengkap">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" required name="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
         
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="nomor_hp" required title="Sesuaikan Inputan" maxlength="12" placeholder="Nomor Handphone">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
            </div><!-- /.col -->
          </div>
        </form>
        <a href="<?php echo base_url() ?>index.php/menu_login" class="text-center">Sudah Punya Akun</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url() ?>template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>template/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url() ?>template/plugins/iCheck/icheck.min.js"></script>
    <script>
	function checkNumber(evt) {
			evt = (evt) ? evt : window.event
			var charCode = (evt.which) ? evt.which : evt.keyCode
			if (  (charCode > 31 || charCode < 32) && ( (charCode < 48 || charCode > 57) && (charCode < 31 || charCode > 32) ) && charCode > 8 ) {
			return false
			}
			return true
		}
		function tes(){
			alert("tes");
		}
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
