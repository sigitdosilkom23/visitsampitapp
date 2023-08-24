<?php
include '../../config.php';
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT b.*,p.title,concat(u.firstname,' ',u.lastname) as name FROM book_list b inner join `packages` p on p.id = b.package_id inner join users u on u.id = b.user_id where b.id = '{$_GET['id']}' ");
    foreach($qry->fetch_assoc() as $k => $v){
        $$k = $v;
    }
}
?>
<style>
    #uni_modal .modal-content>.modal-footer{
        display:none;
    }
</style>
<p><b>Wisata:</b> <?= $title ?></p>
<p><b>Detail:</b> <span class="truncate"><?= strip_tags(stripslashes(html_entity_decode($title))) ?></span></p>
<p><b>Schedule:</b> <?= date("F d, Y",strtotime("schedule")) ?></p>
<form action="" id="book-status">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-group">
        <label for="" class="control-label">Status</label>
        <select name="status" id="" class="select custom-select">
            <option value="0" <?= $status == 0 ? "selected" : '' ?>>Pending</option>
            <option value="1" <?= $status == 1 ? "selected" : '' ?>>Confimed</option>
            <option value="2" <?= $status == 2 ? "selected" : '' ?>>Cancelled</option>
            <option value="3" <?= $status == 3 ? "selected" : '' ?>>Done</option>
        </select>
    </div>
</form>

<div class="modal-footer">
<button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Update</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>

<script>
    $(function(){
        $('#book-status').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_book_status",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        location.reload()
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            })
        })
    })
</script>