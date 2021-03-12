<div class="modal fade" id="modimport">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         
         <div class="modal-header bg-success">
            <h5>Import Pegawai</h5>
         </div>
         <form id="formimport" method="post">
         <div class="modal-body">
            <p>Silahkan Download Template Pegawai Disini <a target="_blank" href="<?php echo base_url('exportimport/templatepegawai'); ?>">Download Template</a></p>
            <div class="form-group">
               <label for="">File Import</label>
               <input type="file" name="fileimport" id="" class="form-control">
            </div>
            <p id="notif"></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-success" id="btimport"><i class="fa fa-check"></i> Import Sekarang</button>
            <a href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Tutup</a>
         </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   $('#formimport').submit(function(e){
      e.preventDefault(); 
      $.ajax({
         url : '<?php echo base_url('Exportimport/newImport'); ?>',
         type : "post",
         data : new FormData(this),
         processData : false,
         contentType : false,
         cache : false,
         beforeSend : function(){
            $('#btimport').html('Sedang Diproses...');
         },
         error : function(html){
            $('#notif').html(html).show();
         },
         success : function(html){
            $('#btimport').html('<i class="fa fa-check"></i> Import Sekarang');
            $('#notif').html(html).show();
         }

      });
   });
</script>