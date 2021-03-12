<div class="">
	<div class="card">
		<div class="card-header with-border bg-gray">
			<h3 class="card-title"><b><i class="fa fa-users"></i> Data Pegawai</b></h3>
			<span class="pull-right"><a href="javascript:void(0)" onclick="importpegawai()" class="btn bg-blue btn-xs"><i class="fa fa-upload"></i> Import Pegawai</a> <a target="_blank" href="<?= base_url('exportimport/exportpegawai'); ?>" class="btn bg-warning btn-xs"><i class="fa fa-download"></i> Export Pegawai</a> <a href="javascript:void(0)" onclick="tambah()" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Pegawai</a></span>
		</div>
		<div class="card-body table-responsive">
			<table id="tabel" class="table table-bordered table-hover">
				<thead>
					<th width="5%">No</th>
					<!-- <th>ID Fingerprint</th> -->
					<th>Nama</th>
					<th>JK</th>
					<th>NRP</th>
					<th>Departemen</th>
					<th>Jabatan</th>
					<th>Lokasi</th>
					<th>Instansi</th>
					<th>Status</th>
					<th width="15%">Aksi</th>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($pegawai->result() as $r) : ?>
						<tr>
							<td><?= $no; ?></td>
							<!-- <td><?= $r->idfp_pegawai; ?></td> -->
							<td><?= $r->nama_pegawai; ?></td>
							<td><?= $r->jk_pegawai; ?></td>
							<td><?= $r->nrp_pegawai; ?></td>
							<td><?= $r->departemen_pegawai; ?></td>
							<td><?= $r->jabatan_pegawai; ?></td>
							<td>
								<?php
								// $dataLokasi = $this->Mlocation->getLokasiKaryawan($r->id_pegawai);
								// var_dump($dataLokasi);
								$dataLokasi = $this->Mlocation->getLokasiKaryawan($r->lokasi);

								if ($dataLokasi != false) {
									echo $dataLokasi['nama_lokasi'];
								} else {
									echo "<i style='font-style: normal;' class='badge badge-danger'>Belum ada lokasi</i>";
								}

								?>
							</td>

							<!-- if ($dataLokasi = null) {
									echo $dataLokasi['nama_lokasi'];
								} else {
									echo "<i style='font-style: normal;' class='badge badge-danger'>Belum ada lokasi</i>";
								} -->
							<td><?= $this->Minstansi->getInstansion($r->instansi)['instansi'] ?></td>
							<td><?= $r->status_pegawai; ?></td>
							<td>
								<a href="javascript:void(0)" onclick="edit('<?= $r->id_pegawai; ?>')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
								<a href="javascript:void(0)" onclick="hapus('<?= $r->id_pegawai; ?>','<?= $r->nama_pegawai; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
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
			type: "GET",
			url: "<?= base_url('admin/tambahpegawai'); ?>",
			cache: false,
			async: false,
			success: function(html) {
				$("#tambah").html(html).show();
				$('#modtambah').modal('show');
			}
		});
	}

	function importpegawai() {
		$.ajax({
			type: "GET",
			url: "<?= base_url('admin/importpegawai'); ?>",
			cache: false,

			success: function(html) {
				$("#import").html(html).show();
				$('#modimport').modal('show');
			}
		});
	}

	function edit(id) {
		$.ajax({
			type: "GET",
			url: "<?= base_url('admin/editpegawai/'); ?>" + id,
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
				title: "Menghapus Pegawai Ini?",
				text: "Tekan ya untuk menghapus (" + isi + ")",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Batal',
			})
			.then(function() {
					$.ajax({
						type: "GET",
						url: "<?= base_url('pegawai/hapus/'); ?>" + id,
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