<div class="">
	<div class="card">
		<div class="card-header with-border bg-gray">
			<h3 class="card-title"><b><i class="fa fa-map"></i> Koordinat Lokasi</b></h3>
			<span class="pull-right">
				<a href="javascript:void(0)" onclick="tambah()" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Koordinat</a></span>
		</div>
		<div class="card-body table-responsive">
			<table class="table table-bordered table-hover" id="tabel">
				<thead>
					<th width="5%">No</th>
					<th>Lokasi</th>
					<th>Koordinat</th>
					<th>Aksi</th>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($koordinat as $r) {
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $r->nama_lokasi; ?></td>
							<td><?php echo $r->jarak; ?></td>
							<td>
								<a href="javascript:void(0)" onclick="edit('<?php echo $r->id_koordinat; ?>')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
								<a href="javascript:void(0)" onclick="hapus('<?php echo $r->id_koordinat; ?>','<?php echo $r->jarak; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>
					<?php $no++;
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="import"></div>
<div id="tambah"></div>
<div id="edit"></div>
<script>
	function tambah() {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('admin/tambahkoordinat'); ?>",
			cache: false,
			async: false,
			success: function(html) {
				$("#tambah").html(html).show();
				$('#modtambah').modal('show');
			}
		});
	}


	function edit(id) {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('admin/editkoordinat/'); ?>" + id,
			data: {
				id: id
			},
			cache: false,
			async: false,
			success: function(html) {
				$("#edit").html(html).show();
				$('#modedit').modal('show');
			}
		});
	}

	function hapus(id, isi) {
		swal({
				title: "Menghapus koordinat Ini?",
				text: "Tekan ya untuk menghapus (" + isi + ")",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Batal',
			})
			.then(function() {
					$.ajax({
						type: "GET",
						url: "<?php echo base_url('admin/deletekoordinat/'); ?>" + id,
						cache: false,
						async: false,
						success: function(response) {
							document.location.reload();
						}
					});
				},
				function(dismiss) {
					if (dismiss === 'cancel') {}
				})
	}

	function setUser(id, isi) {
		swal({
				title: "Set Sebagai User?",
				text: "Tekan ya untuk Membuat User (" + isi + "), Username dan Password sesuai dengan NRP Pegawai (Default)",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Batal',
			})
			.then(function() {
					$.ajax({
						type: "GET",
						url: "<?php echo base_url('pegawai/setuser/'); ?>" + id,
						cache: false,
						async: false,
						success: function(response) {
							document.location.reload();
						}
					});
				},
				function(dismiss) {
					if (dismiss === 'cancel') {}
				})
	}
</script>
<?php if ($this->session->flashdata('msg') == 'simpan') { ?>
	<script>
		iziToast.show({
			timeout: 5000,
			color: 'green',
			title: 'Berhasil Disimpan',
			position: 'topRight',
			pauseOnHover: true,
			transitionIn: false
		});
	</script>
<?php } ?>
<?php if ($this->session->flashdata('msg') == 'edit') { ?>
	<script>
		iziToast.show({
			timeout: 5000,
			color: 'blue',
			title: 'Berhasil Diedit',
			position: 'topRight',
			pauseOnHover: true,
			transitionIn: false
		});
	</script>
<?php } ?>
<?php if ($this->session->flashdata('msg') == 'hapus') { ?>
	<script>
		iziToast.show({
			timeout: 5000,
			color: 'red',
			title: 'Berhasil Dihapus',
			position: 'topRight',
			pauseOnHover: true,
			transitionIn: false
		});
	</script>
<?php } ?>