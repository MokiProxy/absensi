<div class="modal fade" id="modtambah">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5><b>Tambah Data</b></h5>
         </div>
         <div class="card-body table-responsive">
            <form action="<?php echo base_url('lock/tambah') ?>" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <label for="">lokasi</label>
                     <select name="lokasi" class="form-control">
                        <?php foreach ($lokasi as $r) { ?>
                           <option value="<?php echo $r->id_lokasi  ?>"><?php echo "{$r->nama_lokasi}" ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group">
                  <button type="button" class="btn btn-primary" onclick="getLocation()">Koordinat</button><br>
                     <label for="">Longtitude</label>
                     <input type="text" name="long" id="lang" class="form-control">
                  </div>
                  <div class="form-group">
                     <label for="">Langtitude</label>
                     <input type="text" name="lang"  id="lat" class="form-control">
                  </div>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Simpan</button>
                  <a href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Tutup</a>
               </div>
            </form>
         </div>
      </div>
