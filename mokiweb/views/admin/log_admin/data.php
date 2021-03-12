<div class="">
	<div class="card">
		<div class="card-header with-border bg-gray">
			<h3 class="card-title"><b><i class="fa fa-users"></i> Data Log Admin</b></h3>
		</div>
		<div class="card-body table-responsive">
			<table id="tabel" class="table table-bordered table-hover">
				<thead>
					<th width="5%">No</th>
					<th>Nama Admin</th>
					<th>Ip Address</th>
					<th>Activity</th>
					<th>Date</th>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php if($data){ foreach ($data->result() as $r) : ?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $r->nama_admin; ?></td>
							<td><?= $r->ip_address; ?></td>
							<td><?= $r->activity; ?></td>
							<td><?= date("d-m-Y H:i:s", strtotime($r->date_create)); ?></td>
						</tr>
						<?php $no++; ?>
					<?php endforeach; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>