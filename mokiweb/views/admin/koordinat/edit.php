<div class="modal fade" id="modedit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Edit Koordinat</b></h5>
            </div>
            <form action="<?= base_url('admin/editkoordinataction') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">lokasi</label>
                        <select name="lokasi" class="form-control">
                            <?php foreach ($lokasi as $r) { ?>
                                <option value="<?php echo $r->id_lokasi  ?>" <?php echo $r->id_lokasi == $row->id_lokasi ? 'selected' : ''; ?>><?php echo "{$r->nama_lokasi}" ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">koordinat</label>
                        <input type="number" name="koordinat" id="" value="<?= $row->jarak ?>" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $row->id_koordinat ?>">
                <div class="modal-footer">
                    <button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                    <a href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>