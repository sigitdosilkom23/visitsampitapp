<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Live Chat</h3>
        <div class="card-tools">
            <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-flat btn-primary"><span
                    class="fas fa-plus"></span> jawab user ini</a>
        </div>
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
                        $ip='';
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $ip = $_GET['id'];
                        }
					$i = 1;
						$qry = $conn->query("SELECT ip_address from `shout_box` where id = '{$ip}' order by ip_address desc");
                        $row = $qry->fetch_assoc();
		                $ipAddress = $row['ip_address'];
                        $qry = $conn->query("SELECT * from `shout_box` where ip_address = '{$ipAddress}' order by ip_address desc");
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
                                    <a class="dropdown-item"
                                        href="?page=livechat/manage&ip=<?= $row['ip_address'] ?>"><span
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jawab user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user_info">
                        <?php 
                            $ip='';
                            if(isset($_GET['id']) && $_GET['id'] > 0){
                                $ip = $_GET['id'];
                            }
                            $qry = $conn->query("SELECT ip_address from `shout_box` where id = '{$ip}' order by ip_address desc");
                            $row = $qry->fetch_assoc();
                            $ipAddress = $row['ip_address'];
                        ?>
                        <input type="hidden" name="ip_address" id="ip_address" value="<?php echo $ipAddress; ?>">
                        <label for="shout_message">Jawaban:</label>
                        <textarea class="form-control" name="shout_message" id="shout_message" col="20"
                            rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" name="save_message" id="save_message"
                            class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#save_message').click(
            function () { // Menggunakan ID selector (#save_message) bukan class selector (.save_message)
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=reply_chat",
                    method: "POST",
                    data: {
                        ip_address: $('#ip_address').val(),
                        message: $('#shout_message').val(),
                    },
                    dataType: "json",
                    error: err => {
                        console.log(err)
                        alert_toast("An error occurred.", 'error');
                        end_loader();
                    },
                    success: function (resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            alert_toast("Message sent successfully.", 'success');
                            location.reload();
                        } else {
                            alert_toast("An error occurred.", 'error');
                            end_loader();
                        }
                    }
                })
            })
        $('.table').dataTable();
    })
</script>