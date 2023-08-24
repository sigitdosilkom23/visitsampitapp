<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `video` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?= isset($id) ? "Update " : " Tambah Video Terbaru" ?></h3>
    </div>
    <div class="card-body">
        <form action="" id="package-form">
            <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
            <div class="form-group">
                <label for="name" class="control-label">Nama </label>
                <input type="text" step="any" class="form form-control" name="name"
                    value="<?= isset($name) ? $name : ''; ?>">
            </div>
            <div class="form-group">
                <label for="desc" class="control-label">Deskripsi</label>
                <textarea name="desc" id="" cols="30" rows="2"
                    class="form-control form no-resize summernote"><?= isset($description) ? $description : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="img" class="control-label">Video</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input rounded-circle" id="customFile" name="video" required>
                    <label class="custom-file-label" for="customFile">Pilih File</label>
                    <div id="filename"></div>

                    <p> File didatabase :
                        <?php
                        if (isset($loc)) {
                            $filename = basename($loc); 
                            $trimmed_filename = substr($filename, strpos($filename, '/') + 1); 
                            echo $trimmed_filename; 
                        }
                        ?>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-flat btn-primary" form="package-form">Simpan</button>
        <a class="btn btn-flat btn-default" href="?page=penginapan">Batal</a>
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
                url: _base_url_ + "classes/Master.php?f=save_video",
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
                        location.href = "./?page=video";
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