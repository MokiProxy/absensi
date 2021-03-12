<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="Aplikasi Absensi Pegawai" />
  <meta name="description" content="Aplikasi Absensi Pegawai">
  
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

<body class="hold-transition login-page" style="background:url('<?php echo base_url(); ?>/file/background/back.jpg')
no-repeat center center fixed; background-size: cover;
 -webkit-background-size: cover; 
 -moz-background-size: cover; -o-background-size: cover;">
  <!-- <div class="login-box"> -->
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="overlay loading"><i class="fa fa-spinner fa-spin"></i></div>
      <div class="card-body login-card-body">
      <!-- <center><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo mk.png" width='120' hight='120' alt="logo"></a></center> -->
      <h4 class="text-center">Kehadiran Pegawai</h4>
      <p class="login-box-msg text-center">Masukkan NRP Pegawai</p>
      <div id="notif"></div>
      <form id="formabsen" action="javascript:;">
        <input type="hidden" name="latitude" id="latitude" value="">
        <input type="hidden" name="longitude" id="longitude" value="">
        <div class="input-group mb-3">
          <input type="text" name="nrp" class="form-control" required="" placeholder="NRP Pegawai...">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="">
          <button class="btn btn-primary btn-block" onclick="return absenmasuk()">Absen Masuk <i class="fa fa-check-circle"></i></button>
          <button class="btn btn-warning btn-block" onclick="return absenpulang()">Absen Pulang <i class="fa fa-exclamation-circle"></i></button>
        </div>
        <!-- /.col -->
      </form>
      <hr>
      <div class="social-auth-links text-center mb-3">
        
      </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      navigator.geolocation.getCurrentPosition(function(position) {
        tampilLokasi(position);
      }, function(e) {
        alert('Geolocation Tidak Mendukung Pada Browser Anda');
      }, {
        enableHighAccuracy: true
      });
      $('.loading').hide();
    });

    function absenmasuk() {
      let latitude = $('#latitude').val();
      let longitude = $('#longitude').val();
      if((latitude == null) || (latitude == '') || (longitude == null) || (longitude == '') ){
        alert('Lokasi Harap di Aktifkan');
        return false;
      }
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('absen/absenpegawai?absen=masuk'); ?>",
        data: $('#formabsen').serialize(),
        cache: false,
        beforeSend: function() {
          $('.loading').show();
        },
        success: function(response) {
          $('[name="nrp"]').val('');
          $("#notif").html(response).show();
          $('.loading').hide();
        }
      });
    }

    function absenpulang() {
      let latitude = $('#latitude').val();
      let longitude = $('#longitude').val();
      if((latitude == null) || (latitude == '') || (longitude == null) || (longitude == '') ){
        alert('Lokasi Harap di Aktifkan');
        return false;
      }
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('absen/absenpegawai?absen=pulang'); ?>",
        data: $('#formabsen').serialize(),
        cache: false,
        beforeSend: function() {
          $('.loading').show();
        },
        success: function(response) {
          $('[name="nrp"]').val('');
          $("#notif").html(response).show();
          $('.loading').hide();
        }
      });
    }

    function tampilLokasi(posisi) {
      //console.log(posisi);
      var latitude = posisi.coords.latitude;
      var longitude = posisi.coords.longitude;
      $('#latitude').val(latitude);
      $('#longitude').val(longitude);
      /*
      $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url('absen/ambillokasi'); ?>',
        data  : 'latitude='+latitude+'&longitude='+longitude,
        success : function (e) {
          if (e) {
            $('#lokasi').val(e);
            alert(e);
          }else{
            $('#lokasi').val('');
          }
        }
      })*/
    }
  </script>
  <!-- /.login-card -->
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
</body>

</html>