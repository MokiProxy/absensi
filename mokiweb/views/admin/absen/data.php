<div class="">
	<div class="card">
		<div class="card-header with-border bg-gray">
			<h3 class="card-title"><b><i class="fa fa-calendar"></i> Data Absen</b></h3>
			<span class="pull-right"><a data-toggle="modal" data-target="#modex" class="btn bg-warning btn-xs"><i class="fa fa-download"></i> Export Absen</a></span>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-stripe table-hover table-pegawai">
				<thead>
					<th>id_absen</th>
					<th width="5%">No</th>
					<th>Tanggal</th>
					<!-- <th>ID Fingerprint</th> -->
					<th>Nama</th>
					<th>NRP</th>
					<!-- <th>Departemen</th> -->
					<th>Jabatan</th>
					<th>Masuk</th>
					<th>Pulang</th>
					<th>Instansi</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>IP</th>
					<th width="10%">Aksi</th>
					
				</thead>
			</table>
		</div>
	</div>
</div>

<div class="modal fade modal-form-absen">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">

         <div class="modal-header bg-success">
            <h5> Form Edit Absen</h5>
         </div>
         <form class="form-absen" action="<?= base_url('absen/update'); ?>">
	         <div class="modal-body">
	            <div class="form-group col-md-8">
	               <label for="pegawai" class="text-capitalize">pegawai</label>
	               <input type="hidden" name="id_absen" id="id_absen" class="form-control" autocomplete="off">
	               <select name="pegawai" id="pegawai" class="form-control" readonly>
	               </select>
	            </div>

	            <div class="form-group col-md-8">
	               <label for="masuk absen" class="text-capitalize">masuk absen</label>
	               <input type="text" name="masuk_absen" id="masuk_absen" class="form-control" autocomplete="off">
	           </div>

	            <div class="form-group col-md-8">
	               <label for="pulang absen" class="text-capitalize">pulang absen</label>
	               <input type="text" name="pulang_absen" id="pulang_absen" class="form-control" autocomplete="off">
	           </div>
	         </div>
	         <div class="modal-footer">
	            <button class="btn btn-success btn-save"><i class="fa fa-save"></i> Save</button>
	         </div>
         </form>

      </div>
  </div>
</div>

<div class="modal fade" id="modex">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         
         <div class="modal-header bg-success">
            <h5>Export Absen</h5>
         </div>
         <form method="get" target="_blank" action="<?php echo base_url('exportimport/exporttanggal'); ?>">
         <div class="modal-body row">
            <div class="form-group col-md-12">
               <label for="">Instansi</label>
               <select type="text" name="instansi" id="instansi" class="form-control text-capitalize" autocomplete="off" required></select>
            </div>
            <div class="form-group col-md-6">
               <label for="">Dari Tanggal</label>
               <input type="text" name="dari" id="" class="form-control tgl" autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
            </div>
            <div class="form-group col-md-6">
               <label for="">Sampai Tanggal</label>
               <input type="text" name="sampai" id="" class="form-control tgl" autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn btn-success" id="btimport"><i class="fa fa-check"></i> Export</button>
            <a href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Tutup</a>
         </div>
         </form>
      </div>
   </div>
</div>
<script>
	function hapus(id,isi){
		swal({
		  title: "Menghapus Absen Ini?",
		  text: "Tekan ya untuk menghapus ("+isi+")",
		  type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
		})
		.then(function () {
        	$.ajax({
				type : "GET",
				url : "<?php echo base_url('absen/hapus/'); ?>"+id,
				cache : false,
				async : false,
				success : function(response){
					document.location.reload();
				}
			});
      },
      function (dismiss) {
        if(dismiss === 'cancel') {
        }
      })
	}

	$(function(){

		$('#masuk_absen, #pulang_absen').daterangepicker({
		    timePicker : true,
		    singleDatePicker	: true,
		    showDropdowns		: true,
		    timePickerSeconds 	: true,
		    startDate : false,
	        locale : {
	            format: 'DD/MM/YYYY HH:mm:ss',
	        },
		});

		$('.table-pegawai').on('click', '.btn-edit', function(e) {
			let data = table_pegawai.row($(this).parents('tr')).data();
			$(".form-absen")[0].reset();

			$("#id_absen").val(data.id_absen);
			$("#pegawai").val(data.id_pegawai);
			$("#masuk_absen").val((data.masuk_absen != null) ? moment(data.masuk_absen).format('DD/MM/YYYY HH:mm:ss') : moment().format('DD/MM/YYYY HH:mm:ss'));
			$("#pulang_absen").val((data.pulang_absen != null) ? moment(data.pulang_absen).format('DD/MM/YYYY HH:mm:ss') : moment().format('DD/MM/YYYY HH:mm:ss'));
			$(".modal-form-absen").modal("show");
		});

		$('.btn-save').on('click', function(e) {
			e.preventDefault(e);
			let url 	= $(".form-absen").attr('action');
			let data 	= $(".form-absen").serialize();

			$.post(url, data, function(result){
				$(".modal-form-absen").modal("hide");
				table_pegawai.ajax.reload();

				swal({
				  title: "Update Data Absen",
				  text: "Berhasil update data absen",
				  type: "success",
		          confirmButtonText: 'Tutup',
				});

			}).fail(function(){
				swal({
				  title: "Update Data Absen",
				  text: "Gagal update data absen",
				  type: "error",
		          confirmButtonText: 'Tutup',
				});
			});

		});

		function options_pegawai(){
			let url = "<?= base_url('admin/data_pegawai') ?>";
			let options = `<option value='' hidden>pilih pegawai</option>`;
			$.get(url, function(data){
				var pegawai = JSON.parse(data);

				$.each(pegawai.data, function(key, value){
					options += `<option value='`+value.id_pegawai+`'>`+value.nama_pegawai+`</option>`;
				});

				$("#pegawai").append(options);

			});
		}
		options_pegawai();

		function options_instansi(){
			let url = "<?= base_url('admin/data_instansi') ?>";
			let options = `<option value='' hidden>pilih instansi</option>`;
			$.get(url, function(data){
				var instansi = JSON.parse(data);

				$.each(instansi.data, function(key, value){
					options += `<option value='`+value.id_instansi+`'>`+value.instansi+`</option>`;
				});

				$("#instansi").append(options);

			});
		}
		options_instansi();


		function table_pegawai(){

	        if ($.fn.DataTable.isDataTable('.table-pegawai')) {
	            table_pegawai.destroy();
	        }

			table_pegawai = $('.table-pegawai').DataTable( {
		        ajax 	: "<?= base_url('admin/data_absen') ?>",
		        processing : true,
		        // serverSide : true,
		        lengthMenu : [
			        [10, 25, 50, -1],
			        [10, 25, 50, "All"]
		        ],
		        order : [[1, 'asc']],
		        columns : [
			        {
			        	data : "id_absen",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        	visible	: false
			        },
			        {
			        	data : "id_pegawai",
			        	name : "",
			        	render: function (data, type, row, meta) {
					        return meta.row + meta.settings._iDisplayStart + 1;
					    },
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "masuk_absen",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        // {
			        // 	data : "idfp_pegawai",
			        // 	name : "",
			        // 	className : "",
			        // 	defaultContent : "-",
			        // },
			        {
			        	data : "nama_pegawai",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "nrp_pegawai",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        // {
			        // 	data : "departemen_pegawai",
			        // 	name : "",
			        // 	className : "",
			        // 	defaultContent : "-",
			        // },
			        {
			        	data : "jabatan_pegawai",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "masuk_absen",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "pulang_absen",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "instansi",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "lat_absen",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "long_absen",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "ip_absen",
			        	name : "",
			        	className : "",
			        	defaultContent : "-",
			        },
			        {
			        	data : "id_absen",
			        	name : "",
			        	render: function (data, type, row, meta) {
			        			var html = '';
			        		 <?php if ($this->session->hak_akses == '1') { ?>
			        	 html = `
			        		
			        			<button class="btn btn-info btn-xs btn-edit"><i class="fa fa-edit"></i>Edit</button>
			        			<a href="javascript:void(0)" onclick="hapus('`+row.id_absen+`')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus </a>`;

			        		<?php } ?>
			        		
					        return html;
					    },
			        	className : "",
			        	defaultContent : "-",
			        }
		        ]
		    });
		}

		table_pegawai();

	})
</script>
<?php if($this->session->flashdata('msg')=='simpan'){ ?>
<script>
	iziToast.show({timeout:5000,color:'green',title: 'Berhasil Disimpan',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>
<?php if($this->session->flashdata('msg')=='edit'){ ?>
<script>
	iziToast.show({timeout:5000,color:'blue',title: 'Berhasil Diedit',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>
<?php if($this->session->flashdata('msg')=='hapus'){ ?>
<script>
	iziToast.show({timeout:5000,color:'red',title: 'Berhasil Dihapus',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>