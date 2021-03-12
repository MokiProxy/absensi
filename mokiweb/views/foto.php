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
      <div class="card-body login-card-body">
      <div id="camera">Capture</div>
      </br>
    <div id="webcam">
        <input type=button value="Capture" class="btn btn-primary btn-block" onClick="preview()">
    </div>
    <div id="simpan" style="display:none">
        <input type=button value="Remove"  class="btn btn-danger btn-block" onClick="batal()">
        <input type=button value="Save"  class="btn btn-success btn-block" onClick="simpan()" >
    </div>
 
    <div id="hasil"></div>
      <hr>
      <div class="social-auth-links text-center mb-3">
        
      </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
  <script src="https://pixlcore.com/demos/webcamjs/webcam.min.js"></script>
  <script language="Javascript">
        // konfigursi webcam
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpg',
            jpeg_quality: 100
        });
        Webcam.attach( '#camera' );
 
        function preview() {
            // untuk preview gambar sebelum di upload
            Webcam.freeze();
            // ganti display webcam menjadi none dan simpan menjadi terlihat
            document.getElementById('webcam').style.display = 'none';
            document.getElementById('simpan').style.display = '';
        }
        
        function batal() {
            // batal preview
            Webcam.unfreeze();
            
            // ganti display webcam dan simpan seperti semula
            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
        }
        
        function simpan() {
            // ambil foto
            Webcam.snap( function(data_uri) {
                
                // upload foto
                Webcam.upload( data_uri, '<?= base_url(); ?>auth/save_foto', function(code, text) {} );
              
                window.location.href = "<?= base_url('auth'); ?>";

                // tampilkan hasil gambar yang telah di ambil
                // document.getElementById('hasil').innerHTML = 
                //     '<p>Hasil : </p>' + 
                //     '<img src="'+data_uri+'"/>';
                
                // Webcam.unfreeze();
            
                // document.getElementById('webcam').style.display = '';
                // document.getElementById('simpan').style.display = 'none';
            } );
        }
    </script>
  <!-- /.login-card -->
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
</body>

</html>