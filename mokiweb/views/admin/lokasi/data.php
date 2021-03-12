<div class="">
	<div class="card">
		<div class="card-header with-border bg-gray">
			<h3 class="card-title"><b><i class="fa fa-users"></i> Data Lokasi</b></h3>
			<span class="pull-right">
				<a href="javascript:void(0)" onclick="tambah()" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Lokasi</a></span>
		</div>
		<div class="card-body table-responsive">
			<table id="tabel" class="table table-bordered table-hover">
				<thead>
					<th width="5%">No</th>
					<th>Lokasi</th>
					<th>Aksi</th>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($location as $r) : ?>
						<tr>
							<td><?= $no; ?></td>

							<td><?= $r->nama_lokasi; ?></td>

							<td>
								<a href="javascript:void(0)" onclick="edit('<?= $r->id_lokasi; ?>')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
								<a href="javascript:void(0)" onclick="hapus('<?= $r->id_lokasi; ?>','<?= $r->nama_lokasi; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>
						<?php $no++; ?>
					<?php endforeach; ?>
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
			type: "POST",
			url: "<?= base_url('admin/tambahlokasi'); ?>",
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
			url: "<?= base_url('admin/editlokasi/'); ?>" + id,
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
				title: "Menghapus Lokasi Ini?",
				text: "Tekan ya untuk menghapus (" + isi + ")",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Batal',
			})
			.then(function() {
					$.ajax({
						type: "GET",
						url: "<?= base_url('admin/hapuslokasi/'); ?>" + id,
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