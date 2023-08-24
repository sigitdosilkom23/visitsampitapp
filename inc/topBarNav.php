 <!-- Navigation-->
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" id="mainNav">
   <div class="container-fluid">
     <a class="navbar-brand" href="#page-top"><span class="text-waring">WisataKotim.</span></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
       aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
       Menu
       <i class="fas fa-bars ms-1"></i>
     </button>
     <div class="collapse navbar-collapse" id="navbarResponsive">
       <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
         <li class="nav-item"><a class="nav-link" href="<?= $page != 'home' ? './' : ''  ?>">Home</a></li>
         <li class="nav-item"><a class="nav-link" href="./?page=packages">Visit Kotim</a></li>
         <li class="nav-item">
           <div class="dropdown">
             <button class="btn nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
               KATEGORI WISATA
             </button>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               <a class="dropdown-item" href="./?page=kategori&id=1">Wisata Budaya</a>
               <a class="dropdown-item" href="./?page=kategori&id=2">Wisata Religi</a>
               <a class="dropdown-item" href="./?page=kategori&id=3">Wisata Alam</a>
               <a class="dropdown-item" href="./?page=kategori&id=4">Wisata Dalam Kota</a>
               <a class="dropdown-item" href="./?page=kategori&id=5">Wisata Sejarah</a>

             </div>
           </div>
         </li>
         <li class="nav-item">
           <div class="dropdown">
             <button class="btn nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
               LAINNYA
             </button>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               <?php
                $pack = $conn->query("SELECT * FROM `categories` ORDER BY id DESC");
                ?>
               <?php while ($row = $pack->fetch_assoc()) : ?>
               <a class="dropdown-item" href="./?page=hotel&id=<?php echo $row['id']; ?>"> <?= $row['cat'] ?></a>
               <?php endwhile; ?>

             </div>
           </div>
         </li>
         <li class="nav-item"><a class="nav-link" href="<?= $page != 'home' ? './' : ''  ?>#about">Tentang</a></li>
         <li class="nav-item"><a class="nav-link" href="<?= $page != 'home' ? './' : ''  ?>#contact">Saran</a></li>
         <form class="d-flex" action="http://localhost/tourism/search.php" method="GET">
           <input class="form-control me-2" type="search" placeholder="Cari objek wisata" aria-label="Search"
             name="search">
           <button class="btn btn-outline-success" type="submit">Cari</button>
         </form>
       </ul>
     </div>
   </div>
 </nav>
 <script>
   $(function () {
     $('#login_btn').click(function () {
       uni_modal("", "login.php", "large")
     })
     $('#navbarResponsive').on('show.bs.collapse', function () {
       $('#mainNav').addClass('navbar-shrink')
     })
     $('#navbarResponsive').on('hidden.bs.collapse', function () {
       if ($('body').offset.top == 0)
         $('#mainNav').removeClass('navbar-shrink')
     })
   })
 </script>