<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Live Chat</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="30%">
                        <col width="10%">
                        <col width="10%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>Message</th>
                            <th>Tanggal</th>
                            <th>Ip Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `shout_box` group by ip_address order by ip_address desc");
						while($row = $qry->fetch_assoc()):
					?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= $row['user'] ?></td>
                            <td>
                                <p class="truncate-1 m-0"><?= $row['message'] ?></p>
                            </td>
                            <td><?= date("Y-m-d H:i",strtotime($row['date_time'])) ?></td>
                            <td><?= $row['ip_address'] ?></td>
                            <td align="center">
                                <button type="button"
                                    class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="?page=livechat/manage&id=<?= $row['id'] ?>"><span
                                            class="fa fa-edit text-primary"></span> Jawab</a>
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
            _conf("Apakah kamu yakin menghapus secara permanen?", "delete_chat", [$(this)
                .attr('data-id')
            ])
        })
        $('.table').dataTable();
    })

    function delete_chat($id) {
        start_loader();
        // console.log($id);
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_chat",
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
                    alert_toast("success delete", 'success');
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>