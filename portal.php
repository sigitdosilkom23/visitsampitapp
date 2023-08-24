<style>
	header.masthead {
		background-image: url('<?= validate_image($_settings->info('cover')) ?>') !important;
	}

	header.masthead .container {
		background: #0000006b;
	}

	.admin_status {
		position: sticky;
		top: 0;
		z-index: 9999;
	}

	.admin_status .message {
		color: #fff;
		padding: 5px 10px;
		border-radius: 3px;
	}


	.shout_box {
		background: #627BAE;
		width: 260px;
		overflow: hidden;
		position: fixed;
		bottom: 10px;
		right: 10px;
		z-index: 9;
	}


	.shout_box .header .close_btn {
		background: url(images/close_btn.png) no-repeat 0 0;
		float: right;
		width: 15px;
		height: 15px;
	}

	.shout_box .header .close_btn:hover {
		background: url(images/close_btn.png) no-repeat 0 -16px;
	}

	.shout_box .header .open_btn {
		background: url(images/close_btn.png) no-repeat 0 -32px;
		float: right;
		width: 15px;
		height: 15px;
	}

	.shout_box .header .open_btn:hover {
		background: url(images/close_btn.png) no-repeat 0 -48px;
	}

	.shout_box .header {
		padding: 5px;
		font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
		font-weight: bold;
		color: #fff;
		border: 1px solid rgba(0, 39, 121, 0.76);
		border-bottom: none;
		cursor: pointer;
	}

	.shout_box .header:hover {
		background-color: #627BAE;
	}

	.shout_box .message_box {
		background: #FFFFFF;
		height: 200px;
		overflow: auto;
		border: 1px solid #CCC;
	}

	.shout_msg {
		margin-bottom: 10px;
		display: block;
		border-bottom: 1px solid #F3F3F3;
		padding: 0 5px 5px 5px;
		font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
		color: #7C7C7C;
	}

	.message_box:last-child {
		border-bottom: none;
	}

	time {
		font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
		font-weight: normal;
		float: right;
		color: #D5D5D5;
	}

	.shout_msg .username {
		margin-bottom: 10px;
		margin-top: 10px;
	}

	.user_info input {
		width: 98%;
		height: 25px;
		border: 1px solid #CCC;
		border-top: none;
		padding: 3px;
		font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
	}

	.shout_msg .username {
		font-weight: bold;
		display: block;
	}
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

		// Muat pesan setiap 1000 milidetik dari server.
		let load_data = {
			'fetch': 1
		};
		window.setInterval(function () {
			$.post('./shout.php', load_data, function (data) {
				$('.message_box').html(data);
				var scrolltoh = $('.message_box')[0].scrollHeight;
				$('.message_box').scrollTop(scrolltoh);
			});
		}, 1000);

		//Metode untuk memicu saat pengguna menekan tombol enter
		$("#shout_message").keypress(function (evt) {
			if (evt.which == 13) {
				var iusername = $('#shout_username').val();
				var imessage = $('#shout_message').val();
				post_data = {
					'username': iusername,
					'message': imessage
				};

				$.post('./shout.php', post_data, function (data) {

					$(data).hide().appendTo('.message_box').fadeIn();
					//Terus  ke bawah obrolan!
					var scrolltoh = $('.message_box')[0].scrollHeight;
					$('.message_box').scrollTop(scrolltoh);

					//Reset nilai kotak pesan
					$('#shout_message').val('');
					$('#shout_username').val(iusername);

				}).fail(function (err) {

					//Peringatan kesalahan server HTTP
					alert(err.statusText);
				});
			}
		});

		//Toggle hide / show shoutbox
		$(".close_btn").click(function (e) {
			//get CSS display state of .toggle_chat element
			var toggleState = $('.toggle_chat').css('display');

			//toggle show/hide chat box
			$('.toggle_chat').slideToggle();

			//use toggleState var to change close/open icon image
			if (toggleState == 'block') {
				$(".header div").attr('class', 'open_btn');
			} else {
				$(".header div").attr('class', 'close_btn');
			}


		});
	});
</script>
<!-- Masthead-->
<header class="masthead">
	<div class="container">
		<div class="masthead-subheading">Sampit - Kalimantan Tengah</div>
		<div class="masthead-heading text-uppercase">Jelajahi Wisata Kotim</div>
		<a class="btn btn-primary btn-xl text-uppercase" href="#home">Lihat Wisata</a>
	</div>
</header>
<!-- Services-->
<section class="page-section" id="about">
	<div class="container">
		<div class="text-center">
			<h3 class="section-heading text-uppercase">Objek Wisata <b>Unggulan</b></h3>
			<div class="d-flex w-100 justify-content-center">
				<hr class="border-warning" style="border:3px solid" width="15%">
			</div>
		</div>
		<div class="row">
			<?php
			$packages = $conn->query("SELECT DISTINCT packages.* 
			FROM `packages`
			JOIN rate_review ON  packages.id = rate_review.package_id
			WHERE rate_review.rate = 5 
			ORDER BY packages.id DESC 
			LIMIT 3");
			while ($row = $packages->fetch_assoc()) :
				$cover = '';
				if (is_dir(base_app . DIRECTORY_SEPARATOR . $row['upload_path'])) {
					$img = scandir(base_app . DIRECTORY_SEPARATOR . $row['upload_path']);
					$files = array_diff($img, array('.', '..'));
					$im = $img[0];
					if (isset($img[2])) {
						$im = $img[2];
					}
					$cover = $row['upload_path'] . '/' . $im;
				}
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));

				$review = $conn->query("SELECT * FROM `rate_review` where rate=5 AND package_id='{$row['id']}'");
				$review_count = $review->num_rows;
				$rate = 0;
				while ($r = $review->fetch_assoc()) {
					$rate += $r['rate'];
				}
				if ($rate > 0 && $review_count > 0)
					$rate = number_format($rate / $review_count, 0);
			?>
			<div class="col-md-4 p-4 ">
				<div class="card w-100 rounded-0">
					<img class="card-img-top" src="<?= validate_image($cover) ?>" alt="<?= $row['title'] ?>"
						height="200rem" style="object-fit:cover">

					<div class="card-body">
						<h5 class="card-title truncate-1 w-100"><?= $row['title'] ?></h5><br>
						<div class=" w-100 d-flex justify-content-start">
							<div class="stars stars-small">
								<form action="">
									<input disabled class="star star-5" id="star-5" type="radio" name="star"
										<?= $rate == 5  ? "checked" : '' ?> />
									<label class="star star-5" for="star-5"></label>

									<input disabled class="star star-4" id="star-4" type="radio" name="star"
										<?= $rate == 4  ? "checked" : '' ?> />
									<label class="star star-4" for="star-4"></label>

									<input disabled class="star star-3" id="star-3" type="radio" name="star"
										<?= $rate == 3  ? "checked" : '' ?> />
									<label class="star star-3" for="star-3"></label>

									<input disabled class="star star-2" id="star-2" type="radio" name="star"
										<?= $rate == 2  ? "checked" : '' ?> />
									<label class="star star-2" for="star-2"></label>

									<input disabled class="star star-1" id="star-1" type="radio" name="star"
										<?= $rate == 1  ? "checked" : '' ?> />
									<label class="star star-1" for="star-1"></label>
								</form>

							</div>
						</div>
						<p class="card-text truncate"><?= $row['description'] ?></p>
						<div class="w-100 d-flex justify-content-end">
							<a href="./?page=view_package&id=<?= $row['id'] ?>"
								class="btn btn-sm btn-flat btn-warning">Lihat Wisata <i
									class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<!-- wisata baru -->
<section class="page-section bg-dark" id="home">
	<div class="container">
		<h2 class="text-center">Update Wisata Baru</h2>
		<div class="d-flex w-100 justify-content-center">
			<hr class="border-warning" style="border:3px solid" width="15%">
		</div>
		<div class="row">
			<?php
			$packages = $conn->query("SELECT DISTINCT packages.* FROM `packages` JOIN rate_review ON packages.id = rate_review.package_id WHERE rate_review.rate = 5 ORDER BY packages.id DESC LIMIT 3");
			while ($row = $packages->fetch_assoc()) :
				$cover = '';
				if (is_dir(base_app . DIRECTORY_SEPARATOR . $row['upload_path'])) {
					$img = scandir(base_app . DIRECTORY_SEPARATOR . $row['upload_path']);
					$files = array_diff($img, array('.', '..'));
					$im = $img[0];
					if (isset($img[2])) {
						$im = $img[2];
					}
					$cover = $row['upload_path'] . '/' . $im;
				}
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));

				$review = $conn->query("SELECT * FROM `rate_review` where rate=5 AND package_id='{$row['id']}'");
				$review_count = $review->num_rows;
				$rate = 0;
				while ($r = $review->fetch_assoc()) {
					$rate += $r['rate'];
				}
				if ($rate > 0 && $review_count > 0)
					$rate = number_format($rate / $review_count, 0);
			?>
			<div class="col-md-4 p-4 ">
				<div class="card w-100 rounded-0">
					<img class="card-img-top" src="<?= validate_image($cover) ?>" alt="<?= $row['title'] ?>"
						height="200rem" style="object-fit:cover">

					<div class="card-body">
						<h5 class="card-title truncate-1 w-100"><?= $row['title'] ?></h5><br>
						<div class=" w-100 d-flex justify-content-start">
							<div class="stars stars-small">
								<form action="">
									<input disabled class="star star-5" id="star-5" type="radio" name="star"
										<?= $rate == 5  ? "checked" : '' ?> />
									<label class="star star-5" for="star-5"></label>

									<input disabled class="star star-4" id="star-4" type="radio" name="star"
										<?= $rate == 4  ? "checked" : '' ?> />
									<label class="star star-4" for="star-4"></label>

									<input disabled class="star star-3" id="star-3" type="radio" name="star"
										<?= $rate == 3  ? "checked" : '' ?> />
									<label class="star star-3" for="star-3"></label>

									<input disabled class="star star-2" id="star-2" type="radio" name="star"
										<?= $rate == 2  ? "checked" : '' ?> />
									<label class="star star-2" for="star-2"></label>

									<input disabled class="star star-1" id="star-1" type="radio" name="star"
										<?= $rate == 1  ? "checked" : '' ?> />
									<label class="star star-1" for="star-1"></label>
								</form>

							</div>
						</div>
						<p class="card-text truncate"><?= $row['description'] ?></p>
						<div class="w-100 d-flex justify-content-end">
							<a href="./?page=view_package&id=<?= $row['id'] ?>"
								class="btn btn-sm btn-flat btn-warning">Lihat Wisata <i
									class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<div class="d-flex w-100 justify-content-end">
			<a href="./?page=packages" class="btn btn-flat btn-warning mr-4">Jelajah Wisata <i
					class="fa fa-arrow-right"></i></a>
		</div>
	</div>
</section>



<?php
$pack = $conn->query("SELECT *
	FROM `categories`
	ORDER BY `id` DESC
");
?>
<?php while ($rowCat = $pack->fetch_assoc()) : ?>
<section class="page-section bg-white" id="home">
	<div class="container">
		<h2 class="text-center">Daftar <?= $rowCat['cat'] ?></h2>
		<div class="d-flex w-100 justify-content-center">
			<hr class="border-warning" style="border:3px solid" width="15%">
		</div>
		<div class="row" style="display: flex; justify-content: center;">
			<?php
				$packages = $conn->query("SELECT *
			FROM `hostelry`
			WHERE type = '{$rowCat['id']}'
			ORDER BY id DESC
			LIMIT 3;
			");
				while ($rowPackage = $packages->fetch_assoc()) :
					$cover = '';
					if (is_dir(base_app . DIRECTORY_SEPARATOR . $rowPackage['photo'])) {
						$img = scandir(base_app . DIRECTORY_SEPARATOR . $rowPackage['photo']);
						$files = array_diff($img, array('.', '..'));
						$im = $img[0];
						if (isset($img[2])) {
							$im = $img[2];
						}
						$cover = $rowPackage['photo'] . '/' . $im;
					}
					$rowPackage['desc'] = strip_tags(stripslashes(html_entity_decode($rowPackage['desc'])));

				?>
			<div class="col-md-4 p-4 ">
				<div class="card w-100 rounded-0">
					<img class="card-img-top" src="<?= validate_image($cover) ?>" alt="<?= $rowPackage['title'] ?>"
						height="200rem" style="object-fit:cover">

					<div class="card-body">
						<h5 class="card-title truncate-1 w-100 justify-content-center"><?= $rowPackage['name'] ?></h5>
						<br>
						<p class="card-text truncate"><?= $rowPackage['desc'] ?></p>
						<div class="w-100 d-flex justify-content-end">
							<a href="https://www.google.com/maps/search/?api=1&query=<?= $rowPackage['lat'] ?>,<?= $rowPackage['lng'] ?>"
								target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg"
									width="16" height="16" fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
									<path fill-rule="evenodd"
										d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z" />
								</svg> Lihat lokasi di peta
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<div class="d-flex w-100 justify-content-end">
			<a href="./?page=hotel&id=<?= $rowCat['id'] ?>" class="btn btn-flat btn-warning mr-4">Jelajah
				<?= $rowCat['cat'] ?> <i class="fa fa-arrow-right"></i></a>
		</div>
	</div>
</section>
<?php endwhile; ?>


<!-- video -->
<section class="page-section bg-white" id="video">
	<div class="container">
		<div class="text-center">
			<h2 class="section-heading text-uppercase">Video Perkenalan</h2>
		</div>
		<div class="embed-responsive embed-responsive-16by9">
			<video class="embed-responsive-item" controls autoplay>
				<?php
				$qry = $conn->query("SELECT * from `video` limit 1 ");
				$row = $qry->fetch_assoc();
				?>
				<source src="<?= validate_video('classes/' . $row['loc']) ?>" type="video/mp4">
				<source src="<?= validate_video('classes/' . $row['loc']) ?>" type="video/webm">
				<p>Maaf, browser Anda tidak mendukung pemutaran video.</p>
			</video>
		</div>
	</div>
</section>

<!-- About-->
<section class="page-section bg-black" id="about">
	<div class="container">
		<div class="text-center">
			<h2 class="section-heading text-uppercase">Tentang</h2>
		</div>
		<div>
			<div class="card w-100">
				<div class="card-body">
					<?= file_get_contents(base_app . 'about.html') ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Contact-->
<section class="page-section" id="contact">
	<div class="container">
		<div class="text-center">
			<h2 class="section-heading text-uppercase">Saran & Masukan</h2>
			<h3 class="section-subheading text-muted">Jikalau ada Pertanyaan silahkan mengisi form dibawah.</h3>
			<h6 class="section-subheading text-muted">*Untuk Subject bisa di berikan tanda (-).</h6>
		</div>
		<!-- * * * * * * * * * * * * * * *-->
		<!-- * * SB Forms Contact Form * *-->
		<!-- * * * * * * * * * * * * * * *-->
		<!-- This form is pre-integrated with SB Forms.-->
		<!-- To make this form functional, sign up at-->
		<!-- https://startbootstrap.com/solution/contact-forms-->
		<!-- to get an API token!-->
		<form id="contactForm">
			<div class="row align-items-stretch mb-5">
				<div class="col-md-6">
					<div class="form-group">
						<!-- Name input-->
						<input class="form-control" id="name" name="name" type="text" placeholder="Your Name *"
							required />
					</div>
					<div class="form-group">
						<!-- Email address input-->
						<input class="form-control" id="email" name="email" type="email" placeholder="Your Email *"
							data-sb-validations="required,email" />
					</div>
					<div class="form-group mb-md-0">
						<input class="form-control" id="subject" name="subject" type="subject" placeholder="Subject *"
							required />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-group-textarea mb-md-0">
						<!-- Message input-->
						<textarea class="form-control" id="message" name="message" placeholder="Your Message *"
							required></textarea>
					</div>
				</div>
			</div>
			<div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton"
					type="submit">Kirim Pesan</button></div>
		</form>
	</div>
</section>
<!-- <div class="shout_box">
	<div class="header ">Live Chat <div class="close_btn"> X </div>
	</div>
	<div class="toggle_chat">
		<div class="message_box">
		</div>
		<div class="user_info">
			<input name="shout_username" id="shout_username" type="text" placeholder="Your Name" maxlength="15" />
			<input name="shout_message" id="shout_message" type="text" placeholder="Type Message Hit Enter"
				maxlength="100" />
		</div>
	</div>
</div> -->
<script>
	$(function () {
		$('#contactForm').submit(function (e) {
			e.preventDefault()
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_inquiry",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				error: err => {
					console.log(err)
					alert_toast("an error occured", 'error')
					end_loader()
				},
				success: function (resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						alert_toast("Pesan terkirim", 'success')
						$('#contactForm').get(0).reset()
					} else {
						console.log(resp)
						alert_toast("an error occured", 'error')
						end_loader()
					}
				}
			})
		})
	})
</script>