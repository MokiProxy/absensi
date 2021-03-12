<?php
if ($this->session->userdata('islogin') != 'admin') {
  redirect(base_url('auth/login'));
}

$ad = $this->Mauth->akunadmin($this->session->userdata('id_admin'))->row();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="Aplikasi Absen Pegawai PT.SBS" />
  <meta name="description" content="Aplikasi Absen Pegawai PT.SBS">
  <title>Admin | Aplikasi Absen Pegawai</title>
  <!-- FAVICONS ICON -->
  <link rel="icon" href="<?php echo base_url('assets/front') ?>/images\favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/front') ?>/images\favicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.css">
  <!-- ekko-lightbox -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/dist/css/select2.min.css">

  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Java Script -->
  <script src="<?php echo base_url('assets'); ?>/dist/js/jquery-3.1.0.min.js"></script>
  <!-- Izi Alert-->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/izi/dist/css/iziToast.min.css">
  <script type="text/javascript" src="<?php echo base_url('assets'); ?>/plugins/izi/dist/js/iziToast.min.js"></script>
  <!-- Sweet Alert css -->
  <link href="<?php echo base_url('assets'); ?>/plugins/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/magnific-popup/magnific-popup.css">
  <style type="text/css">
    table {
      font-size: 12px;
    }
  </style>

  <!-- datatables.min.css -->
  <!-- <link type="text/css" rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->

  <!-- jQuery -->
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets'); ?>/plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url('assets'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js" defer></script>
  <script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js" defer></script>

  <script src="<?php echo base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets'); ?>/dist/js/demo.js"></script>
  <!-- Sweet Alert Js  -->
  <script src="<?php echo base_url('assets'); ?>/plugins/sweet-alert/sweetalert2.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- bootstrap datepicker -->

  <script src="<?php echo base_url('assets'); ?>/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- DataTables -->

  <script src="<?php echo base_url() ?>assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.js"></script>

  <!-- highchart -->
  <!-- <script src="<?php echo base_url('assets'); ?>/plugins/highchart/code/highcharts-3d.js"></script> -->
  <script src="<?php echo base_url('assets'); ?>/plugins/highchart/code/highcharts.js"></script>
  <script src="<?php echo base_url('assets'); ?>/plugins/highchart/code/modules/exporting.js"></script>
  <script src="<?php echo base_url('assets'); ?>/plugins/highchart/code/modules/export-data.js"></script>
  <!-- Magnific Popup core CSS file -->
  <script type="text/javascript" src="<?php echo base_url('assets'); ?>/dist/js/jquery.idle.js"></script>
  <!-- datetimepicker -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <script src="<?php echo base_url('assets'); ?>/dist/js/olahangka.js"></script>
  <script>
    $(document).idle({
      // onIdle: function(){
      // window.location="<?php echo base_url('admin/logout'); ?>";                
      // },
      // idle: 180000
    });
  </script>
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block hidden-xs">
          <a href="javascript:void(0)" class="nav-link"></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
          <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url() ?>/file/avatar/kacamata.png" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?php echo $ad->nama_admin; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <img src="<?php echo base_url() ?>/file/avatar/kacamata.png" class="img-circle elevation-2" alt="User Image">

              <p>
                <?php echo $ad->nama_admin; ?>
                <small>Aplikasi Absen Pegawai</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="<?php echo base_url('admin/profil'); ?>" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profil</a>
              <a href="javascript:void(0)" onclick="modlogout()" class="btn btn-default btn-flat float-right"><i class="fa fa-sign-out"></i> Keluar</a>
            </li>
            <script type="text/javascript">
              function modlogout() {
                swal({
                    title: "Keluar Dari Aplikasi?",
                    text: "Tekan Ya Untuk Setuju dan Tekan Batal Jika Tidak Setuju",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                  })
                  .then(function() {
                      window.location = "<?php echo base_url('admin/logout'); ?>";
                    },
                    function(dismiss) {
                      if (dismiss === 'cancel') {

                      }
                    })
              }
            </script>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="javascript:void(0)" class="brand-link text-center">
        <span class="brand-text font-weight-light">ADMINISTRATOR</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header">MENU UTAMA</li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin'); ?>" class="nav-link <?php if ($this->uri->segment(2) == '') {
                                                                            echo 'active';
                                                                          } ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                  <span class="right badge badge-danger">Baru</span>
                </p>
              </a>
            </li>
            <?php if ($this->session->userdata('hak_akses') != '2') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/pegawai'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'pegawai') {
                                                                                      echo 'active';
                                                                                    } ?>">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Pegawai
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/lokasi'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'lokasi') {
                                                                                    echo 'active';
                                                                                  } ?>">
                  <i class="nav-icon fa fa-location-arrow"></i>
                  <p>
                    Lokasi
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/instansi'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'instansi') {
                                                                                    echo 'active';
                                                                                  } ?>">
                  <i class="nav-icon fas fa-landmark"></i>
                  <p>
                    Instansi
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/koordinat'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'koordinat') {
                                                                                        echo 'active';
                                                                                      } ?>">
                  <i class="nav-icon fa fa-map"></i>
                  <p>
                    Koordinat
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/lock'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'lock') {
                                                                                  echo 'active';
                                                                                } ?>">
                  <i class="nav-icon fa fa-lock"></i>
                  <p>
                    Lock Lokasi
                  </p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?php echo base_url('admin/log_admin'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'log-admin') {
                                                                                  echo 'active';
                                                                                } ?>">
                <i class="nav-icon fa fa-history"></i>
                <p>
                  Log Admin
                </p>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/absen'); ?>" class="nav-link <?php if ($this->uri->segment(2) == 'absen') {
                                                                                  echo 'active';
                                                                                } ?>">
                <i class="nav-icon fa fa-calendar"></i>
                <p>
                  Absen
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content pt-3">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <?php echo $_content; ?>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Versi 1.2</b>
      </div>
      
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- AdminLTE App -->
  <!-- <script src="<?php echo base_url('assets'); ?>/dist/js/adminlte.min.js"></script> -->
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?php echo base_url('assets'); ?>/dist/js/demo.js"></script> -->
  <!-- Sweet Alert Js  -->
  <script src="<?php echo base_url('assets'); ?>/plugins/sweet-alert/sweetalert2.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo base_url('assets'); ?>/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets'); ?>/plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url('assets'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- datrangepicker -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.js"></script>
  
  <script src="<?php echo base_url('assets'); ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <script src="<?php echo base_url('assets'); ?>/plugins/select2/js/select2.min.js"></script>
  <script src="<?php echo base_url('assets'); ?>/plugins/magnific-popup/jquery.magnific-popup.js"></script>
  <script type="text/javascript">

$(document).ready(function() {
    $('#tabel').DataTable();
} );

    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
      $('.magnific').magnificPopup({
        type: 'image'
        // other options
      });
      var table = $(".examle").attr("id");
      var uri ='http://localhost/absensi/admin/absen_data';
      $(".example").DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        ajax:{
            url:uri,
            type:"POST",
                }
      });
      $('.tgl').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
      });

      $('.select2').select2();

      $('.hapus_foto').on('click', function(){
          swal({
              title: "Hapus Semua Foto Abseni ?",
              text: "Tekan ya untuk menghapus",
              type: "warning",
              showCancelButton: true,
              confirmButtonText: 'Ya',
              cancelButtonText: 'Batal',
            })
            .then(function() {
              var id = 'hapus foto';
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('crownjob/hapus_foto'); ?>",
                  data: {key: id},
                  cache: false,
                  async: false,
                  success: function(response) {
                    console.log(response);
                    swal({
                      title: "Berhasil",
                      text: "Foto absensi berhasil di hapus",
                      type: "success",
                      showCancelButton: false,
                      confirmButtonText: 'Ya',
                    })
                    .then(function() {
                      document.location.reload();
                    });
                  },
                  error : function(response){
                    console.log(response);
                  }
                });
              },
              function(dismiss) {
                if (dismiss === 'cancel') {}
              })
        });
    })
  </script>
  <script>
    //
  </script>
  <!-- Magnific Popup core JS file -->


</body>

</html>