<style>
    .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 20px;
        font-size: 25px;
        width: 100%;
    }

    .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
    }

    .rating label:last-child {
        position: static;
    }

    .rating label:nth-child(1) {
        z-index: 5;
    }

    .rating label:nth-child(2) {
        z-index: 4;
    }

    .rating label:nth-child(3) {
        z-index: 3;
    }

    .rating label:nth-child(4) {
        z-index: 2;
    }

    .rating label:nth-child(5) {
        z-index: 1;
    }

    .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .rating label .icon {
        float: left;
        color: transparent;
    }

    .rating label:last-child .icon {
        color: #000;
    }

    .rating:not(:hover) label input:checked~.icon,
    .rating:hover label:hover input~.icon {
        color: #ffc800;
    }

    .rating label input:focus:not(:checked)~.icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #ffc800;
    }
</style>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<?php
if (isset($_GET['id'])) {
    $packages = $conn->query("SELECT * FROM `packages` where id = '{$_GET['id']}'");
    if ($packages->num_rows > 0) {
        foreach ($packages->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
    $id_package = $_GET['id'];

    $hostelry = $conn->query("SELECT * FROM `hostelry` WHERE type = 'hotel' AND id_package = '{$_GET['id']}'");
    $countHostelry = $hostelry->num_rows;

    $rmh_mkn = $conn->query("SELECT * FROM `hostelry` WHERE type = 'rmh_mkn' AND id_package = '{$_GET['id']}'");
    $countRmhMkn = $rmh_mkn->num_rows;

    $review = $conn->query("SELECT r.*,concat(firstname,' ',lastname) as uname FROM `rate_review` r inner join users u on r.user_id = u.id where r.package_id='{$id}' AND r.status != 0 order by unix_timestamp(r.date_created) desc");
    $review_count = $review->num_rows;
    $rate = 0;
    $feed = array();
    while ($row = $review->fetch_assoc()) {
        $rate += $row['rate'];
        if (!empty($row['review'])) {
            $row['review'] = stripslashes(html_entity_decode($row['review']));
            $feed[] = $row;
        }
    }


    if ($rate > 0 && $review_count > 0)
        $rate = number_format($rate / $review_count, 0);
    $files = array();
    if (is_dir(base_app . $upload_path)) {
        $ofile = scandir(base_app . $upload_path);
        foreach ($ofile as $img) {
            if (in_array($img, array('.', '..')))
                continue;
            $files[] = validate_image($upload_path . DIRECTORY_SEPARATOR . $img);
        }
    }
}
?>
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div id="tourCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner h-100">
                        <?php foreach ($files as $k => $img) : ?>
                        <div class="carousel-item  h-100 <?= $k == 0 ? 'active' : '' ?>">
                            <img class="d-block w-100  h-100" src="<?= $img ?>" alt="asdasd">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="w-100">
                    <hr class="border-warning">
                    <h5>Rating (<?= $review_count ?>)</h5>
                    <div>
                        <div class="rate">
                            <input disabled class="star star-5" id="star-5" type="radio" name="star"
                                <?= $rate == 5 ? "checked" : '' ?> /> <label class="star star-5" for="star-5"></label>
                            <input disabled class="star star-4" id="star-4" type="radio" name="star"
                                <?= $rate == 4 ? "checked" : '' ?> /> <label class="star star-4" for="star-4"></label>
                            <input disabled class="star star-3" id="star-3" type="radio" name="star"
                                <?= $rate == 3 ? "checked" : '' ?> /> <label class="star star-3" for="star-3"></label>
                            <input disabled class="star star-2" id="star-2" type="radio" name="star"
                                <?= $rate == 2 ? "checked" : '' ?> /> <label class="star star-2" for="star-2"></label>
                            <input disabled class="star star-1" id="star-1" type="radio" name="star"
                                <?= $rate == 1 ? "checked" : '' ?> /> <label class="star star-1" for="star-1"></label>
                        </div>
                    </div>
                    <hr>
                    <div class="w-100 d-flex justify-content-between">
                        <span
                            class="rounded-0 btn-flat btn-sm btn-primary d-flex align-items-center  justify-content-between"><i
                                class="fa fa-tag"></i> <span class="ml-1"><?= number_format($cost) ?></span></span>
                        <!--  <button class="btn btn-flat btn-warning" type="button" id="book">Kunjungi</button> -->
                    </div>
                </div>
                <?php
                if ($countHostelry > 0) {
                ?>
                <div class="w-100">
                    <hr class="border-warning">
                    <h5>Daftar Hotel disekitar</h5>

                    <div class="row">
                        <?php
                            $cardCount = 0;
                            while ($row = $hostelry->fetch_assoc()) :
                                $cover = '';
                                if (is_dir(base_app . DIRECTORY_SEPARATOR . $row['photo'])) {
                                    $img = scandir(base_app . DIRECTORY_SEPARATOR . $row['photo']);
                                    $files = array_diff($img, array('.', '..'));
                                    $im = $img[0];
                                    if (isset($img[2])) {
                                        $im = $img[2];
                                    }
                                    $cover = $row['photo'] . '/' . $im;
                                }
                                $row['desc'] = strip_tags(stripslashes(html_entity_decode($row['desc'])));

                                // Membuat dua card per baris
                                if ($cardCount % 2 == 0) {
                                    // Awal baris, buka div row
                                    echo '<div class="row">';
                                }
                            ?>
                        <div class="col-md-6">
                            <div class="card">
                                <img src="<?= validate_image($cover) ?>" class="card-img-top">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $row['name'] ?> [ <?= $row['type'] ?>]</h4>
                                    <p class="card-text"><?= $row['desc'] ?></p>
                                    <?php
                                            if ($row['lat']) {
                                            ?>
                                    <a href="https://www.google.com/maps/search/?api=1&query=<?= $row['lat'] ?>,<?= $row['lng'] ?>"
                                        target="_blank" rel="noopener noreferrer" class="btn btn-primary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z" />
                                        </svg> Lihat Rute
                                    </a>
                                    <?php
                                            }
                                            ?>
                                </div>
                            </div>
                        </div>
                        <?php
                                $cardCount++;

                                if ($cardCount % 2 == 0) {
                                    // Akhir baris, tutup div row
                                    echo '</div>';
                                }
                                ?>

                        <?php endwhile;

                            // Jika jumlah card tidak habis dibagi 2, maka tutup div row terakhir
                            if ($cardCount % 2 != 0) {
                                echo '</div>';
                            }
                            ?>
                    </div>
                </div>
                <?php
                }
                ?>

                <?php
                if ($countRmhMkn > 0) {
                ?>
                <div class="w-100">
                    <hr class="border-warning">
                    <h5>Daftar Rumah Makan disekitar</h5>

                    <div class="row">
                        <?php
                            $cardCount = 0;
                            while ($row = $rmh_mkn->fetch_assoc()) :
                                $cover = '';
                                if (is_dir(base_app . DIRECTORY_SEPARATOR . $row['photo'])) {
                                    $img = scandir(base_app . DIRECTORY_SEPARATOR . $row['photo']);
                                    $files = array_diff($img, array('.', '..'));
                                    $im = $img[0];
                                    if (isset($img[2])) {
                                        $im = $img[2];
                                    }
                                    $cover = $row['photo'] . '/' . $im;
                                }
                                $row['desc'] = strip_tags(stripslashes(html_entity_decode($row['desc'])));

                                // Membuat dua card per baris
                                if ($cardCount % 2 == 0) {
                                    // Awal baris, buka div row
                                    echo '<div class="row">';
                                }
                            ?>
                        <div class="col-md-6">
                            <div class="card">
                                <img src="<?= validate_image($cover) ?>" alt="<?= $row['title'] ?>"
                                    class="card-img-top">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $row['name'] ?> [ <?= $row['type'] ?>]</h4>
                                    <p class="card-text"><?= $row['desc'] ?></p>
                                    <?php
                                            if ($row['lat']) {
                                            ?>
                                    <a href="https://www.google.com/maps/search/?api=1&query=<?= $row['lat'] ?>,<?= $row['lng'] ?>"
                                        target="_blank" rel="noopener noreferrer" class="btn btn-primary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z" />
                                        </svg> Lihat Rute
                                    </a>
                                    <?php
                                            }
                                            ?>
                                </div>
                            </div>
                        </div>
                        <?php
                                $cardCount++;

                                if ($cardCount % 2 == 0) {
                                    // Akhir baris, tutup div row
                                    echo '</div>';
                                }
                                ?>

                        <?php endwhile;

                            // Jika jumlah card tidak habis dibagi 2, maka tutup div row terakhir
                            if ($cardCount % 2 != 0) {
                                echo '</div>';
                            }
                            ?>
                    </div>
                </div>
                <?php
                }
                ?>

            </div>
            <div class="col-md-7">
                <h3><?= $title ?></h3>
                <hr class="border-warning">
                <small class='text-muted'>Lokasi: <?= $tour_location ?></small>
                <br><br>
                <h4>Detail</h4>
                <div><?= stripslashes(html_entity_decode($description)) ?></div>

                <div>

                    <?php
                    if ($lat) {
                    ?>
                    <h4>Rute Perjalanan</h4>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= $lat ?>,<?= $lng ?>" target="_blank"
                        rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z" />
                        </svg> Lihat lokasi di peta
                    </a>
                    <?php
                    }
                    ?>


                </div>
                <hr>
                <h5>Review (<?= count($feed) ?>)</h5>
                <hr class="border-primary">
                <?php
                $perPage = 2; // number of items per page
                $totalItems = count($feed); // total number of items in the array
                $totalPages = ceil($totalItems / $perPage); // total number of pages

                // get the current page number
                $currentPage = (isset($_GET['pag']) && is_numeric($_GET['pag'])) ? $_GET['pag'] : 1;

                // calculate the offset
                $offset = ($currentPage - 1) * $perPage;

                // get a slice of the array based on the current page and number of items per page
                $feedSlice = array_slice($feed, $offset, $perPage);

                // loop through the sliced array
                foreach ($feedSlice as $r) {
                    // display the content for each item
                ?>
                <div class="w-100 d-flex justify-content-between  align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="<?= validate_image('assets/img/user.jpg') ?>" class="border mr-3 review-user-avatar"
                            alt="">
                        <?php if ($r['uname'] != 'anonim ') : ?>
                        <span><?= $r['uname'] ?></span>
                        <?php else : ?>
                        <span><?= $r['anonim_name'] ?></span>
                        <?php endif ?>
                    </div>
                    <span class='text-muted'><?= date("Y-m-d H:i A", strtotime($r['date_created'])) ?></span>
                </div>
                <div class="w-100 review-feedback">
                    <?= $r['review'] ?>
                </div>
                <div class="w-100">
                    <?php
                        if ($r['photo']) {
                        ?>

                    <img src="<?= validate_photo($r['photo']) ?>" class="img-fluid"
                        style="width: 200px; height: 200px;">
                    <?php
                        }
                        ?>
                </div>
                <hr class='border-light'>
                <?php
                } // end foreach

                // display pagination links if there are more than one page
                if ($totalPages > 1) {
                ?>
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php
                                // create links for each page
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $active = ($i == $currentPage) ? 'active' : '';
                                ?>
                            <li class="page-item <?= $active ?>"><a class="page-link"
                                    href="?page=view_package&id=<?= $id_package ?> &pag=<?= $i ?>"><?= $i ?></a></li>
                            <?php
                                } // end for loop
                                ?>
                        </ul>
                    </nav>
                </div>
                <?php
                } // end if statement
                ?>



                <hr>
                <h5>Komentar</h5>
                <hr class="border-warning">
                <form id="comment" enctype="multipart/form-data">
                    <label for="anonim_name" class="control-label">Your Name</label>
                    <input type="text" id="anonim_name" name="anonim_name" class="form-control mb-3 anonim_name"
                        required>

                    <label for="review" class="control-label">Deskripsi</label>
                    <textarea id="review" name="review" cols="30" rows="2"
                        class="form-control form no-resize summernote"></textarea>

                    <label for="photo" class="control-label">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control mb-3">

                    <label for="rate" class="control-label">Rate</label>
                    <div class="rating">
                        <label>
                            <input type="radio" id="rate" name="rate" value="1" />
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" id="rate" name="rate" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" id="rate" name="rate" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" id="rate" name="rate" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" id="rate" name="rate" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </div>

                    <input type="hidden" id="package_id" class="package_id" name="package_id"
                        value="<?= $id_package ?>">

                    <div class="g-recaptcha" data-sitekey="6LcJzHghAAAAAOC5qWwlxa2ijECGBc8cM9PMKXj7"></div>

                    <div class="text-right mt-3">
                        <button class="btn btn-sm btn-primary" type="submit">POST COMMENT</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<script src="<?= base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
<script>
    let rate

    $(function () {
        $('#book').click(function () {
            if ("<?= $_settings->userdata('id') ?>" > 0)
                uni_modal("Book Info", "book_form.php?package_id=<?= $id ?>");
            else
                uni_modal("", "login.php", "large");
        })

        $(':radio').change(function () {
            rate = this.value
            $('#rate').val(this.value)

        });

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

        $('#comment').submit(function (e) {
            e.preventDefault();

            const name = $('#anonim_name').val();
            const review = $('#review').val();
            // const photo = $('#photo')[0].files[0];
            const photo = $('#photo').prop('files')[0];
            const rate = $('input[name="rate"]:checked').val();
            const captcha = $('textarea[name="g-recaptcha-response"]').val();
            const package_id = $('#package_id').val();

            const formData = new FormData();
            formData.append('anonim_name', name);
            formData.append('review', review);
            formData.append('photo', photo);
            formData.append('rate', rate);
            formData.append('package_id', package_id);
            formData.append('captcha', captcha);

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_comment",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + " " + errorThrown);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function (response) {
                    // console.log(response);
                    alert_toast("Berhasil Komentar", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 2000)
                    // handle the response accordingly
                }
            });
        });

    })
</script>