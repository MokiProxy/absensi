<?php
$listlokasi = $this->Mlocation->getLokasi();
$listinstansi = $this->Minstansi->getInstansion();
?>

<?php foreach ($pegawai->result() as $r); ?>
<?php $dataLokasiKaryawan = $this->Mlocation->getLokasiKaryawan($r->id_pegawai) ?>
<div class="modal fade" id="modedit">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5><b>Edit Pegawai</b></h5>
         </div>
         <form action="<?= base_url('pegawai/edit') ?>" method="post">
            <input type="hidden" name="id_pegawai" id="" class="form-control" value="<?= $r->id_pegawai; ?>">
            <div class="modal-body">
               <div class="form-group">
                  <!-- <label for="idfp_pegawai">ID Fingerprint</label>
                  <input type="text" name="idfp_pegawai" id="idfp_pegawai" class="form-control" value="<?= $r->idfp_pegawai; ?>" required> -->
               </div>
               <div class="form-group">
                  <label for="nama_pegawai">Nama Pegawai</label>
                  <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" value="<?= $r->nama_pegawai; ?>" required>
               </div>
               <div class="form-group">
                  <label for="jk_pegawai">Jenis Kelamin</label>
                  <select class="form-control" name="jk_pegawai" id="jk_pegawai" required>
                     <option value="" selected hidden disabled>Pilih Jenis Kelamin</option>
                     <option value="LAKI-LAKI" <?= ($r->jk_pegawai == 'LAKI-LAKI' ? 'selected' : '') ?>>LAKI-LAKI</option>
                     <option value="PEREMPUAN" <?= ($r->jk_pegawai == 'PEREMPUAN' ? 'selected' : '') ?>>PEREMPUAN</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="nrp_pegawai">NRP Pegawai</label>
                  <input type="text" name="nrp_pegawai" id="nrp_pegawai" class="form-control" value="<?= $r->nrp_pegawai; ?>" required>
               </div>
               <div class="form-group">
                  <label for="departemen_pegawai">Departemen</label>
                  <input type="text" name="departemen_pegawai" id="departemen_pegawai" class="form-control" value="<?= $r->departemen_pegawai; ?>" required>
               </div>
               <div class="form-group">
                  <label for="jabatan_pegawai">Jabatan Pegawai</label>
                  <input type="text" name="jabatan_pegawai" id="jabatan_pegawai" class="form-control" value="<?= $r->jabatan_pegawai; ?>" required>
               </div>
               <div class="form-group">
                  <label for="lokasi_pegawai">Lokasi</label>
                  <select class="form-control" name="lokasi_pegawai" id="lokasi_pegawai" required>
                     <option value="" selected hidden disabled>Pilih Lokasi</option>
                     <?php foreach ($listlokasi as $lokasi) : ?>
                        <option value="<?= $lokasi['id_lokasi'] ?>" <?= ($lokasi['id_lokasi'] == $dataLokasiKaryawan['id_lokasi'] ? 'selected' : '') ?>><?= $lokasi['nama_lokasi'] ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="form-group">
                  <label for="instansi_pegawai">Instansi</label>
                  <select class="form-control" name="instansi_pegawai" id="instansi_pegawai" required>
                     <option value="" selected hidden disabled>Pilih Instansi</option>
                     <?php foreach ($listinstansi as $instansi) : ?>
                        <option value="<?= $instansi['id_instansi'] ?>" <?= ($instansi['id_instansi'] == $r->instansi ? 'selected' : '') ?>><?= $instansi['instansi'] ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="form-group">
                  <label for="status_pegawai">Status</label>
                  <input type="text" name="status_pegawai" id="status_pegawai" class="form-control" value="<?= $r->status_pegawai; ?>" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
               <a href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Tutup</a>
            </div>
         </form>
      </div>
   </div>
</div>