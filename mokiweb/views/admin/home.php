<div class="row">
  <div class="col-lg-4 col-xs-12">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3><?php echo $pegawai->num_rows(); ?></h3>
        <p>PEGAWAI</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="<?php echo base_url('admin/pegawai'); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-4 col-xs-12">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?php echo $absenmasuk->num_rows(); ?></h3>
        <p>ABSEN MASUK</p>
      </div>
      <div class="icon">
        <i class="fa fa-check-circle"></i>
      </div>
      <a href="<?php echo base_url('admin/absen'); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-4 col-xs-12">
    <div class="small-box bg-maroon">
      <div class="inner">
        <h3><?php echo $absenpulang->num_rows(); ?></h3>
        <p>ABSEN PULANG</p>
      </div>
      <div class="icon">
        <i class="fa fa-ban"></i>
      </div>
      <a href="<?php echo base_url('admin/absen'); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<div id="longlat"></div>
