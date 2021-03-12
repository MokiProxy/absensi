<?php
// var_dump($lock);
foreach ($lock->result() as $value); ?>
<div class="modal fade" id="modedit">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5><b>Edit Lock</b></h5>
         </div>
         <form action="<?php echo base_url('lock/edit/' . $this->uri->segment(3)) ?>" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <label for="">lokasi</label>
                  <select name="lokasi" class="form-control">
                     <?php foreach ($lokasi as $r) { ?>
                        <option value="<?php echo $r->id_lokasi  ?>" <?php echo $r->id_lokasi == $value->id_lokasi ? 'selected' : ''; ?>><?php echo "{$r->nama_lokasi}" ?></option>
                     <?php } ?>
                  </select>
               </div>

               <div class="form-group">
               <button type="button" class="btn btn-primary" onclick="getLocation()">Koordinat</button><br>
                  <label for="">Longtitude</label>
                  <input type="hidden" name="id_lock" value="<?= $value->id_lock; ?>" />
                  <input type="text" name="long" id="lang" class="form-control" value="<?php echo $value->long ?>">
               </div>
               <div class="form-group">
                  <label for="">Langtitude</label>
                  <input type="text" name="lang" id="lat" class="form-control" value="<?php echo $value->lang ?>">
               </div>

            </div>
            <div class="modal-footer">
               <button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
               <a href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Tutup</a>
            </div>
      </div>
   </div>