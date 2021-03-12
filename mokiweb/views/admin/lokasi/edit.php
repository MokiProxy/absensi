<div class="modal fade" id="modedit">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5><b>Edit Lokasi</b></h5>
         </div>
         <form action="<?= base_url('admin/tl_editaksi') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="modal-body">
               <div class="form-group">
                  <label for="">Lokasi</label>
                  <input type="text" name="lokasi" id="" value="<?php echo $row->nama_lokasi ?>" class="form-control" required>
                  <input type="hidden" name="id" value="<?php echo $row->id_lokasi ?>">
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
               <a href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Tutup</a>
            </div>
         </form>
      </div>
   </div>
</div>