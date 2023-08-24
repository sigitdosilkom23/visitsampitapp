<section class="page-section bg-dark" id="home">
	<div class="container">

		<h2 class="text-center">Wisata Rekomendasi</h2>
		<div class="d-flex w-100 justify-content-center">
			<hr class="border-warning" style="border:3px solid" width="15%">
		</div>

		<div class="float-left">
			<label class="rating">Filter By Rating</label>
			<div class="rating_section">
				<label
					class="star star-5 start_5 <?= (isset($_GET['rating']) && $_GET['rating'] == 5 ? 'active_rating' : '') ?>"
					onclick="by_rating(5);" onmouseover="set_hover(1,5,0)" onmouseout="set_hover(0,0,1)"
					for="star-5"></label>
				<label
					class="star star-5 start_4 <?= (isset($_GET['rating']) && $_GET['rating'] > 3 ? 'active_rating' : '') ?>"
					onclick="by_rating(4);" onmouseover="set_hover(1,4,0)" onmouseout="set_hover(0,0,1)"
					for="star-5"></label>
				<label
					class="star star-5 start_3 <?= (isset($_GET['rating']) && $_GET['rating'] > 2 ? 'active_rating' : '') ?>"
					onclick="by_rating(3);" onmouseover="set_hover(1,3,0)" onmouseout="set_hover(0,0,1)"
					for="star-5"></label>
				<label
					class="star star-5 start_2 <?= (isset($_GET['rating']) && $_GET['rating'] > 1 ? 'active_rating' : '') ?>"
					onclick="by_rating(2);" onmouseover="set_hover(1,2,0)" onmouseout="set_hover(0,0,1)"
					for="star-5"></label>
				<label
					class="star star-5 start_1 <?= (((isset($_GET['rating']) && $_GET['rating'] == 1) || (isset($_GET['rating']) && $_GET['rating'] > 1)) ? 'active_rating' : '') ?>"
					onclick="by_rating(1);" onmouseover="set_hover(1,1,0)" onmouseout="set_hover(0,0,1)"
					for="star-5"></label>
			</div>
			<label class="all" onclick="window.location='?page=packages'">all</label>
		</div>

		<div class="w-100">
			<?php

			if(isset($_GET['rating'])){

				$packages = $conn->query("select avg(a.rate) as rating, a.package_id, b.* from rate_review a JOIN packages b ON b.id = a.package_id GROUP BY package_id HAVING avg(rate) = '".mysqli_real_escape_string($conn, $_GET['rating'])."'");
			} else{
			
				$packages = $conn->query("SELECT * FROM `packages` order by id DESC");
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
				<img class="card-img-top" src="<?= validate_image($cover) ?>" height="200rem" style="object-fit:cover">
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
							class="btn btn-sm btn-flat btn-warning">Lihat Wisata <i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>

	</div>
</section>