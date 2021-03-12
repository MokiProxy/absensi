<div class="modal fade" id="modtambah">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5><b>Tambah Lokasi</b></h5>
			</div>
			<form action="<?= base_url('admin/tl_aksi') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Lokasi</label>
						<input type="text" name="lokasi" id="" class="form-control" required>
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