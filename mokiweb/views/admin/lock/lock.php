<div class="">
	<div class="card">
		<div class="card-header with-border bg-gray">
			<h3 class="card-title"><b><i class="fa fa-users"></i> Daftar Lock Lokasi Absen</b></h3>
			<span class="pull-right"><a href="javascript:void(0)" onclick="tambah()" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Data</a></span>
		</div>
		<div class="card-body table-responsive">
			<table id="tabel" class="table table-bordered table-hover">
				<thead>
					<th>No</th>
					<th>Nama Lokasi</th>
					<th>Long</th>
					<th>Lang</th>
					<th>Aksi</th>

				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($lock as  $value) { ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $value->nama_lokasi ?></td>
							<td><?php echo $value->long ?></td>
							<td><?php echo $value->lang ?></td>
							<td>
								<a href="javascript:void(0)" onclick="edit('<?php echo $value->id_lock; ?>')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>
								<!-- <a href="<?php echo base_url('Admin/edit/' . $value->id_lock) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a> -->
								<!-- <a href="<?php echo base_url('Admin/hapus/' . $value->id_lock) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a> -->
								<a href="javascript:void(0)" onclick="hapus('<?php echo $value->id_lock; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- <div id="import"></div> -->
	<div id="tambah"></div>
	<div id="edit"></div>
	<script>
		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else {
				x.innerHTML = "Geolocation is not supported by this browser.";
			}
		}

		function showPosition(position) {
			console.log(position);

			document.getElementById('lang').value = position.coords.longitude;
			document.getElementById('lat').value = position.coords.latitude;
		}

		function tambah() {
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('admin/tambahdata'); ?>",
				cache: false,
				async: false,
				success: function(html) {
					$("#tambah").html(html).show();
					$('#modtambah').modal('show');
				}
			});
		}

		function edit(id) {
			// console.log(id);
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('admin/editdata/'); ?>" + id,
				cache: false,
				async: false,
				success: function(html) {
					$("#edit").html(html).show();
					$('#modedit').modal('show');
				}
			});
		}

		function hapus(id, isi) {
			// console.log(id);
			swal({
					title: "Menghapus Data Ini?",
					text: "Tekan ya untuk menghapus (" + isi + ")",
					type: "warning",
					showCancelButton: true,
					confirmButtonText: 'Ya',
					cancelButtonText: 'Batal',
				})
				.then(function() {
						$.ajax({
							type: "GET",
							url: "<?php echo base_url('lock/hapuslock/'); ?>" + id,
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