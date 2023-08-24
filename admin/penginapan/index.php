<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Tempat Lain</h3>
        <div class="card-tools">
            <a href="?page=penginapan/manage" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Tambah
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
                        <col width="10%">
                        <col width="10%">
                        <col width="30%">
                        <col width="10%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Buat</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Deskripsi</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
					$i = 1;
						$qry = $conn->query("SELECT `hostelry`.*, `categories`.`cat`
                        FROM `hostelry`
                        JOIN `categories` ON `hostelry`.`type` = `categories`.`id`
                        ORDER BY `hostelry`.`created_at` DESC
                        ");
						while($row = $qry->fetch_assoc()):
                            $row['desc'] = strip_tags(stripslashes(html_entity_decode($row['desc'])));
					?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= date("Y-m-d H:i",strtotime($row['created_at'])) ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['cat'] ?></td>
                            <td>
                                <p class="truncate-1 m-0"><?= $row['desc'] ?></p>
                            </td>
                            <td>
                                <p class="truncate-1 m-0"><?= $row['lat'] ?>, <?=$row['lng'] ?></p>
                            </td>
                            <td align="center">
                                <button type="button"
                                    class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="?page=penginapan/manage&id=<?= $row['id'] ?>"><span
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
            _conf("Are you sure to delete this hosterly permanently?", "delete_package", [$(this).attr(
                'data-id')])
        })
        $('.table').dataTable();
    })

    function delete_package($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_hotelry",
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