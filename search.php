<?php
if (isset($_GET['search'])) {
  $query = $_GET['search'];
}
?>
<!DOCTYPE html>
<html lang="id" class="" style="height: auto;">

<?php $page = isset($_GET['page']) ? $_GET['page'] : 'portal';  ?>
<?php require_once('config.php'); ?>
<?php require_once('inc/header.php') ?>

<body>
    <?php require_once('inc/topBarNav.php') ?>


    <section class="page-section bg-dark" id="home">
        <div class="container">
            <div class="w-100">
                <?php

                if(isset($_GET['search'])){

                    $count = $conn->query("SELECT * FROM `packages` where title LIKE '%$query%' order by id DESC");
                } else{

                    $count = $conn->query("SELECT * FROM `packages` where title LIKE '%$query%' order by id DESC");

                } ?>
                <h2 class="text-center">Pencarian Wisata</h2>
                <div class="d-flex w-100 justify-content-center">
                    <hr class="border-warning" style="border:3px solid" width="15%">
                </div>
                <div class="row">
                    <h4 class="text-center"> Anda mencari wisata dengan keyword <b>" <?=$query?> "</b> dengan jumlah
                        data
                        sebanyak <b><?php $count=$count->num_rows; echo $count;  ?></b></h4>
                </div>

                <div class="row">
                    <form class="d-flex" action="http://localhost/tourism/search.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Cari objek wisata"
                            aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit">Cari</button>
                    </form>
                </div>
                <br><br>
                <?php

			if(isset($_GET['search'])){

				$packages = $conn->query("SELECT * FROM `packages` where title LIKE '%$query%' order by id DESC");
			} else{
			
				$packages = $conn->query("SELECT * FROM `packages` where title LIKE '%$query%' order by id DESC");

			}       
            
			while ($row = $packages->fetch_assoc()) :
				$cover = '';
				if (is_dir(base_app . DIRECTORY_SEPARATOR . $row['upload_path'])) {
					$img = scandir(base_app . DIRECTORY_SEPARATOR . $row['upload_path']);
					$files = array_diff($img, array('.', '..'));

					$im = $img[0];
					if(isset($img[2])){
						$im = $img[2];
					}
					$cover = $row['upload_path'] . '/' . $im;
				}
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));


				$review = $conn->query("select avg(rate) rating from rate_review WHERE package_id='{$row['id']}'");

				$rating = $review->fetch_assoc()['rating'];
				$rate = number_format($rating); 

			?>

                <div class="card d-flex w-100 rounded-0 mb-3 package-item">
                    <img class="card-img-top" src="<?= validate_image($cover) ?>" alt="<?= $row['title'] ?>"
                        height="200rem" style="object-fit:cover">
                    <div class="card-body">
                        <h5 class="card-title truncate-1"><?= $row['title'] ?></h5>
                        <div class=" w-100 d-flex justify-content-start">
                            <form action="">
                                <div class="stars stars-small">
                                    <input disabled class="star star-5" id="star-5" type="radio" name="star"
                                        <?= $rate == 5 ? "checked" : '' ?> /> <label class="star star-5"
                                        for="star-5"></label>
                                    <input disabled class="star star-4" id="star-4" type="radio" name="star"
                                        <?= $rate == 4 ? "checked" : '' ?> /> <label class="star star-4"
                                        for="star-4"></label>
                                    <input disabled class="star star-3" id="star-3" type="radio" name="star"
                                        <?= $rate == 3 ? "checked" : '' ?> /> <label class="star star-3"
                                        for="star-3"></label>
                                    <input disabled class="star star-2" id="star-2" type="radio" name="star"
                                        <?= $rate == 2 ? "checked" : '' ?> /> <label class="star star-2"
                                        for="star-2"></label>
                                    <input disabled class="star star-1" id="star-1" type="radio" name="star"
                                        <?= $rate == 1 ? "checked" : '' ?> /> <label class="star star-1"
                                        for="star-1"></label>
                                </div>
                            </form>
                        </div>
                        <p class="card-text truncate"><?= $row['description'] ?></p>
                        <div class="w-100 d-flex justify-content-between">
                            <span class="rounded-0 btn btn-flat btn-sm btn-primary"><i class="fa fa-tag"></i>
                                <?= number_format($row['cost']) ?></span>
                            <a href="./?page=view_package&id=<?= $row['id'] ?>"
                                class="btn btn-sm btn-flat btn-warning">Lihat Wisata <i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>

                <?php
                if ($packages->num_rows == 0) {
                    ?>
                <div class="row">
                    <h4 class="text-center">Keyword tidak ditemukan</h4>
                </div>
                <?php
                }

                ?>
            </div>
        </div>
    </section>


    <?php require_once('inc/footer.php') ?>
</body>

</html>