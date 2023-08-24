<?php
$qry = $conn->query("SELECT * from `video` limit 1 ");
$row = $qry->fetch_assoc();
?>

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Video Perkenalan</h3>
        <?php 
            if ($row) {
            ?>
        <div class="card-tools">
            <a href="?page=video/manage&id=<?= $row['id'] ?>" class="btn btn-flat btn-primary"><span
                    class="fas fa-plus"></span> Edit
                Video</a>
        </div>
        <?php
            } else {
?>
        <div class="card-tools">
            <a href="?page=video/manage" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Tambah
                Baru</a>
        </div>
        <?php
            }
        ?>

    </div>
    <div class="card-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-1">Nama </div>
                <div class="col-md-1">: </div>
                <div class="col"><?php echo ($row ? $row['name'] : '-'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1">Deskripsi </div>
                <div class="col-md-1">: </div>
                <div class="col"><?php echo ($row ? $row['description'] : '-'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1">Video </div>
                <div class="col-md-1">: </div>
                <div class="col">
                    <?php 
                    if ($row) {
                    ?>
                    <video controls autoplay width="640" height="360">
                        <source src="<?= validate_video('classes/'.$row['loc']) ?>" type="video/mp4">
                        <source src="<?= validate_video('classes/'.$row['loc']) ?>" type="video/webm">
                        <p>Maaf, browser Anda tidak mendukung pemutaran video.</p>
                    </video>
                    <?php
                    } else {
                        ?>
                    <p>Tidak ada video</p>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>