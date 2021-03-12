<?php 

if($this->session->userdata('islogin')=='admin'){ redirect(base_url('admin')); }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Izi Alert-->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/izi/dist/css/iziToast.min.css">
  <script type="text/javascript" src="<?php echo base_url('assets'); ?>/plugins/izi/dist/js/iziToast.min.js"></script>
  <!-- jQuery -->
  <script src="<?php echo base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition login-page" style="background:url('<?php echo base_url(); ?>/file/background/flatpink.jpg')
no-repeat center center fixed; background-size: cover;
 -webkit-background-size: cover; 
 -moz-background-size: cover; -o-background-size: cover;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <!-- <center><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logonew.png" width='100' hight='100' alt="logo"></a></center>  -->
      <h4 class="text-center">Administrator</h4><p>
      <!-- <p class="login-box-msg text-center">Masukkan Username & Password</p> -->

      <form action="<?php echo base_url('auth/login'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" required="" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" required="" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="">
          <div class="input-group mb-3">
            <div class="icheck-primary">
              <input type="checkcard" id="remember">
              <label for="remember">
                Ingat Saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="">
            <button class="btn btn-primary btn-block">Login <i class="fa fa-sign-in"></i></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>
      <div class="social-auth-links text-center mb-3">
        <p>&copy; <?php echo date ('Y');?></p>
        <p>Versi 1.2</p>
      </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-card -->
<?php if($this->session->flashdata('msg')=='gagal'){ ?>
<script>
  iziToast.show({timeout:5000,color:'red',title: 'Gagal! Username Atau Password Salah',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
</body>
</html>
