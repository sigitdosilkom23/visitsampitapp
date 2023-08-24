<section class="page-section bg-dark" id="home">
    <div class="container">

        <h2 class="text-center">Rumah Makan</h2>
        <div class="d-flex w-100 justify-content-center">
            <hr class="border-warning" style="border:3px solid" width="15%">
        </div>

        <div class="w-100">
            <?php
			
			$packages = $conn->query("SELECT *
			FROM `hostelry`
			WHERE type = 'rmh_mkn'
			ORDER BY id DESC");

			while ($row = $packages->fetch_assoc()) :
				$cover = '';
				if (is_dir(base_app . DIRECTORY_SEPARATOR . $row['photo'])) {
					$img = scandir(base_app . DIRECTORY_SEPARATOR . $row['photo']);
					$files = array_diff($img, array('.', '..'));

					$im = $img[0];
					if(isset($img[2])){
						$im = $img[2];
					}
					$cover = $row['photo'] . '/' . $im;
				}
				$row['desc'] = strip_tags(stripslashes(html_entity_decode($row['desc'])));

			?>
            <div class="card d-flex w-100 rounded-0 mb-3 package-item">
                <img class="card-img-top" src="<?= validate_image($cover) ?>" height="200rem" style="object-fit:cover">
                <div class="card-body">
                    <h5 class="card-title truncate-1"><?= $row['name'] ?></h5>
                    <!-- <div class=" w-100 d-flex justify-content-start">
                        <div class="stars stars-small">
                            <p style="color: black;">Type: <?php 
                                if ($row['type']=="rmh_mkn") {
                                    echo "Rumah Makan";
                                } elseif ($row['type']=="penginapan") {
                                    echo "Penginapan";
                                } elseif ($row['type']=="hotel") {
                                    echo "Hotel";
                                } elseif ($row['type']=="villa") {
                                    echo "Villa";
                                } else {
                                    echo "-";
                                }?></p>
                        </div>
                    </div> -->
                    <p class="card-text truncate"><?= $row['desc'] ?></p>
                    <div class="w-100 d-flex justify-content-end">
                        <!-- <a href="./?page=view_package&id=<?= $row['id'] ?>"
								class="btn btn-sm btn-flat btn-warning">Lihat Wisata <i
									class="fa fa-arrow-right"></i></a> -->
                        <a href="https://www.google.com/maps/search/?api=1&query=<?= $row['lat'] ?>,<?= $row['lng'] ?>"
                            target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z" />
                            </svg> Lihat lokasi di peta
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

    </div>
</section>