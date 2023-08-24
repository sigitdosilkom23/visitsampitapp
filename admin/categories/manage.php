<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `categories` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?= isset($id) ? "Update " : " Tambah Kategori Terbaru" ?></h3>
    </div>
    <div class="card-body">
        <form action="" id="package-form">
            <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
            <div class="form-group">
                <label for="cat" class="control-label">Nama </label>
                <input type="text" step="any" class="form form-control" name="cat"
                    value="<?= isset($cat) ? $cat : ''; ?>">
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-flat btn-primary" form="package-form">Simpan</button>
        <a class="btn btn-flat btn-default" href="?page=categories">Batal</a>
    </div>
</div>
<script>
    document.getElementById('customFile').addEventListener('change', function () {
        var filename = this.value.split('\\').pop();
        document.getElementById('filename').innerHTML =
            'File yang dipilih: ' + filename;
    });
</script>

<script>
    $(document).ready(function () {
        $('#package-form').submit(function (e) {
            e.preventDefault();
            $('.err-msg').remove();
            // console.log(new FormData($(this)[0]));
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_cat",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: function (xhr, status, error) {
                    console.log(error);
                    alert_toast("An error occurred: " + error, 'error');
                    end_loader();
                },
                success: function (resp) {
                    console.log(resp);
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.href = "./?page=categories";
                    } else {
                        alert_toast("An error occurred", 'error');
                        end_loader();
                        console.log(resp);
                    }
                }
            });

        })

        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                    'subscript', 'clear'
                ]],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        })
    })
</script>