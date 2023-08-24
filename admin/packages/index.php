<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?= $_settings->flashdata('success') ?>", 'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Daftar Wisata</h3>
		<div class="card-tools">
			<a href="?page=packages/manage" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Buat
				Baru</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<table class="table table-bordered table-stripped">
					<colgroup>
						<col width="5%">
						<col width="15%">
						<col width="20%">
						<col width="35%">
						<col width="10%">
						<col width="10%">
						<col width="5%">
						<col width="5%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Tanggal Buat</th>
							<th>Wisata</th>
							<th>Deskripsi</th>
							<th>Lokasi</th>
							<th>Kategori</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `packages` order by date(date_created) desc ");
						while($row = $qry->fetch_assoc()):
                            $row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
					?>
						<tr>
							<td class="text-center"><?= $i++; ?></td>
							<td><?= date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?= $row['title'] ?></td>
							<td>
								<p class="truncate-1 m-0"><?= $row['description'] ?></p>
							</td>
							<td>
								<p class="truncate-1 m-0"><?= $row['lat'] ?>, <?=$row['lng'] ?></p>
							</td>
							<td>
								<?php 
									if ($row['type']==1) {
										echo '<p class="truncate-1 m-0">Wisata Budaya</p>';
									} elseif ($row['type']==2) {
										echo '<p class="truncate-1 m-0">Wisata Religi</p>';
									} elseif ($row['type']==3) {
										echo '<p class="truncate-1 m-0">Wisata Alam</p>';
									} elseif ($row['type']==4) {
										echo '<p class="truncate-1 m-0">Wisata Dalam Kota</p>';
									} elseif ($row['type']==5){
										echo '<p class="truncate-1 m-0">Wisata Sejarah</p>';
									} else {
										echo '<p class="truncate-1 m-0">-</p>';
									}
									?>
							</td>
							<td class="text-center">
								<?php if($row['status'] == 1): ?>
								<span class="badge badge-success">Active</span>
								<?php else: ?>
								<span class="badge badge-danger">Inactive</span>
								<?php endif; ?>
							</td>
							<td align="center">
								<button type="button"
									class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
									data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="?page=packages/manage&id=<?= $row['id'] ?>"><span
											class="fa fa-edit text-primary"></span> Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)"
										data-id="<?= $row['id'] ?>"><span class="fa fa-trash text-danger"></span>
										Delete</a>
								</div>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('.delete_data').click(function () {
			_conf("Are you sure to delete this package permanently?", "delete_package", [$(this).attr(
				'data-id')])
		})
		$('.table').dataTable();
	})

	function delete_package($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_package",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function (resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>