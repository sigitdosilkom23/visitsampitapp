<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `hostelry` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?= isset($id) ? "Update ": " Tambah Baru" ?></h3>
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
                    class="form-control form no-resize summernote"><?= isset($desc) ? $desc : ''; ?></textarea>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col md-6">
                        <label for="lat" class="control-label">Lokasi Penginapan (latitude)</label>
                        <input type="text" step="any" class="form form-control" name="lat"
                            value="<?= isset($lat) ? $lat : ''; ?>">
                    </div>

                    <div class="col md-6">
                        <label for="lng" class="control-label">Lokasi Penginapan (longitude)</label>
                        <input type="text" step="any" class="form form-control" name="lng"
                            value="<?= isset($lng) ? $lng : ''; ?>">
                    </div>
                </div>
                <a href="https://support.google.com/maps/answer/18539?hl=id&co=GENIE.Platform%3DDesktop" target="_blank"
                    rel="noopener noreferrer">Tutorial mendapatkan latitude dan longitude</a>
            </div>

            <div class="form-group">
                <label for="type" class="control-label">Type : </label>
                <?php 
                    $pack = $conn->query("SELECT * FROM `categories` ORDER BY id DESC");
                ?>
                <select name="type" class="form-control" required>
                    <?php while ($row = $pack->fetch_assoc()): ?>


                    <option value="<?php echo $row['id']; ?>" <?php 
                        if(isset($type)&&$type == $row['id']){
                            echo 'selected';
                        }
                    ?>>
                        <?php echo $row['cat']; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="package" class="control-label">Wisata Terdekat:</label>
                <?php 
                    $pack = $conn->query("SELECT * FROM `packages` ORDER BY id DESC");
                ?>
                <select name="id_package" class="form-control" required>
                    <?php while ($row = $pack->fetch_assoc()): ?>


                    <option value="<?php echo $row['id']; ?>" <?php 
                        if(isset($id_package)&&$id_package == $row['id']){
                            echo 'selected';
                        }
                    ?>>
                        <?php echo $row['title']; ?>
                    </option>
                    <?php endwhile; ?>

                </select>
            </div>

            <div class="form-group">
                <label for="img" class="control-label">Gambar</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img[]" multiple
                        accept="image/*" onchange="displayImg(this,$(this))">
                    <label class="custom-file-label" for="customFile">Pilih File</label>
                </div>
            </div>



            <?php if(isset($photo) && is_dir(base_app.$photo)): ?>
            <?php 
                $file= scandir(base_app.$photo);
                foreach($file as $img):
                    if(in_array($img,array('.','..')))
                        continue;                  
            ?>
            <div class="d-flex w-100 align-items-center img-item">
                <span><img src="<?= base_url.$photo.'/'.$img ?>" width="150px" height="100px" style="object-fit:cover;"
                        class="img-thumbnail" alt=""></span>
                <span class="ml-4"><button class="btn btn-sm btn-default text-danger rem_img" type="button"
                        data-path="<?= base_app.$photo.'/'.$img ?>"><i class="fa fa-trash"></i></button></span>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-flat btn-primary" form="package-form">Simpan</button>
        <a class="btn btn-flat btn-default" href="?page=penginapan">Batal</a>
    </div>
</div>
<script>
    function displayImg(input, _this) {
        // console.log(input.files)
        var fnames = []
        Object.keys(input.files).map(k => {
            fnames.push(input.files[k].name)
        })
        _this.siblings('.custom-file-label').html(JSON.stringify(fnames))

    }

    function delete_img($path) {
        start_loader()

        $.ajax({
            url: _base_url_ + 'classes/Master.php?f=delete_p_img',
            data: {
                path: $path
            },
            method: 'POST',
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured while deleting an Image", "error");
                end_loader()
            },
            success: function (resp) {
                $('.modal').modal('hide')
                if (typeof resp == 'object' && resp.status == 'success') {
                    $('[data-path="' + $path + '"]').closest('.img-item').hide('slow', function () {
                        $('[data-path="' + $path + '"]').closest('.img-item').remove()
                    })
                    alert_toast("Gambar berhasil dihapus", "success");
                } else {
                    console.log(resp)
                    alert_toast("An error occured while deleting an Image", "error");
                }
                end_loader()
            }
        })
    }
    $(document).ready(function () {
        $('.rem_img').click(function () {
            _conf("Apakah kamu yakin menghapus Gambar secara Permanen?", 'delete_img', ["'" + $(this)
                .attr('data-path') + "'"
            ])
        })
        $('#package-form').submit(function (e) {
            e.preventDefault();
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_hotelry",
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
                        location.href = "./?page=penginapan";
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