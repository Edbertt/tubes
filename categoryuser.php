<?php
    include("includes/koneksi.php");

    if(strlen($_SESSION['username'])==0)
    { 
      header('location:index.php');
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Alam Indonesia</title>

    <!-- ============== Bar Icon ================= -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-finance-business.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!--


-->
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <div class="sub-header">
      <div class="container">
              
      </div>
    </div>

    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="user.php"><h2>Alam Indonesia</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#top">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>                       
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
              <?php 
                $query = mysqli_query($con, "Select * from  akun where username='".$_SESSION['username']."'");
                while($row = mysqli_fetch_array($query)){
              ?>
                <?php if($_SESSION['userType'] == 1){?>
                <li class="nav-item">
                <a href="editprofile.php?said=<?php echo htmlentities($row['id']);?>" class="nav-link"> <?= "Halo ";?> <?= $_SESSION['nama_depan']; ?> <?= $_SESSION['nama_belakang'];?> </a>
                </li>
                <li class="nav-item">
                <a href="admin/admin/dashboard.php" class="nav-link"> Admin Panel </a>
                </li>
                <?php } ?>
                <?php if($_SESSION['userType'] == 0){ ?>
                <li class="nav-item">
                  <a href="editprofile.php?said=<?php echo htmlentities($row['id']);?>" class="nav-link"> <?= "Halo ";?> <?= $_SESSION['nama_depan']; ?> <?= $_SESSION['nama_belakang'];?> </a>
                </li>
                <?php } ?>
              <li class="nav-item">
                <a class="nav-link" href="login/logout.php">Logout</a>
              </li>
            <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text" id="top">
        <div class="Modern-Slider">
          <!-- Item -->
          <div class="item item-1">
            <div class="img-fill">
                <div class="text-content">
                  <h6>Welcome to Indonesian Nature</h6>
                  <h4>Indonesian Nature <br> Website</h4>
                  <p>If you have any questions, you can click the button below during business hours, thank you..</p>
                  <a href="contact.html" class="filled-button">contact us</a>
                </div>
            </div>
          </div>
          <!-- // Item -->
          <!-- Item -->
          <div class="item item-2">
            <div class="img-fill">
                <div class="text-content">
                  <h6>Welcome to Indonesian Nature</h6>
                  <h4>Indonesian Nature <br> Website</h4>
                  <p>You can see some tourist attractions in Indonesia to add references to your vacation spots</p>
                </div>
            </div>
          </div>
          <!-- // Item -->
          <!-- Item -->
          <div class="item item-3">
            <div class="img-fill">
                <div class="text-content">
                  <h6>Welcome to Indonesian Nature</h6>
                  <h4>Indonesian Nature <br> Website</h4>
                  <p>CARE AND LOVE NATURE THEN THEY WILL GIVE THE BEST FOR US.</p>
                </div>
            </div>
          </div>
          <!-- // Item -->
        </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="request-form">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h4>Website bagi para traveller!!</h4>
            <p><span>INDONESIAN NATURE WEBSITE </span> merupakan portal web yang menyajikan berita dan artikel seputar tempat wisata di Indonesia.
              Di website ini juga memberikan rekomendasi tempat kuliner disekitar tempat wisata tersebut. Semoga teman-teman semua terbantu dengan adanya website ini.</p>
            <br>
            <h4>Visi</h4>
            <p>Menjadikan pesona wisata indonesia yang indah dan di kenal oleh manca negara melalui pengenalan tempat wisata pada website</p>
            <br><br>
            <h4>Misi</h4>
            <p>-Meningkatkan ketertarikan wisatawan dari luar maupun dalam negri.<br>
              -Memperkenalkan Alam Indonesia yang indah ini kepada seluruh dunia.<br>
              -Menambah pendapatan daerah dan juga negara lewat pariwisata Indonesia terlebih dimasa pandemi sekarang ini.
            </p>
          </div>
          <div class="col-md-4 border-button">
            
          </div>
        </div>
      </div>
    </div>

    <div class="services">
      <div class="container">
      <div class="row">

    <?php 
        if($_GET['catid']!=''){
            $_SESSION['catid']=intval($_GET['catid']);
        }

        $sql1 = "SELECT * FROM kategori WHERE id = '".$_SESSION['catid']."'";
        $query1 = mysqli_query($con,$sql1);
        while($row1=mysqli_fetch_array($query1)){
    ?>

    
        
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Pariwisata<em> di <?php echo htmlentities($row1['CategoryName']);?></em></h2>
              <span> </span>
            </div>
          </div>
      </div>

    <?php } ?>
    <?php
        
        $sql2 = "SELECT * FROM berita WHERE CategoryId = '".$_SESSION['catid']."' && Is_Active='1'";
        $query2 = mysqli_query($con,$sql2);
        $indicator = 0;

        while ($row2=mysqli_fetch_array($query2)) {
          if($indicator % 3 == 0){
    ?>          
          <div class="row">
    <?php } ?>
          <div class="col-md-4">
            <div class="service-item">
              <img src="admin/admin/postimages/<?php echo htmlentities($row2['PostImage']);?>" alt="" height="210px" width="330px">
              <div class="down-content">
                <h4><?php echo htmlentities($row2['judul']);?></h4>
                <p><?php
                    $ring=$row2['ringkasan'];
                    echo (substr($ring,0));?> </p>
                <a href="newsdetailuser.php?nid=<?php echo htmlentities($row2['id']); ?>" class="filled-button">Read More</a>
              </div>
            </div>
          </div>

    <?php if($indicator % 3 == 2){?>
          </div>
          <br>
    <?php }
    $indicator++; } ?>

    </div>
    </div>


    <div class="fun-facts">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="left-content">
              <span></span>
              <h2>Pariwisata Indonesia yang<em> sudah diakui dunia</em></h2>
              <h4><b>1. Borobudur</b></h4>
              <p>Borobudur dibangun pada abad ke-8 dan merupakan candi terbesar di dunia, yang menjadi situs Warisan Dunia UNESCO. Candi ini sempat hilang selam berabad-abad akibat timbunan abu vulkanik. 
              Saat ditemukan pada 1800-an, banyak yang menduga, gundukan bukit itu adalah bukit yang ternyata candi raksasa. 
              Borobudur memiliki panorama matahari terbit dan tenggelam yang luar biasa. Lokasinya berada di Kabupaten Magelang dan berdekatan dengan Yogyakarta, membuatnya menjadi destinasi wisata sejarah dan budaya.</p>
              <br><br><h4><b>2. Danau Toba</b></h4>
              <p>Danau Toba adalah danau terbesar di Indonesia juga Asia Tenggara. Selain itu, Danau Toba juga merupakan danau terbesar kedua di dunia.  
                Dengan luas lebih dari 1.145 kilometer persegi dan kedalaman 450 meter, Danau Toba sebenarnya lebih mirip lautan. Danau Toba terletak di Provinsi Sumatra Utara dan masuk di beberapa Kabupaten.
                Yakni, Kabupaten Samosir, Toba Samosir, Simalungun, Karo, Tapanuli Utara, Humbang Hasundutan, dan Dairi. 
                Pulau Samosir di tengah Danau Toba memiliki luas 64.000 hektare atau setara dengan negara Singapura</p>
              <br><br><h4><b>3. Gunung Bromo</b></h4>
              <p>Meskipun bukan salah satu gunung tertinggi di Indonesia, namun keelokan Gunung Bromo tidak ada duanya. Hal ini membuat para wisatawan dapat merasakan pemandangan yang epic dan spektakuler.
                Wisatawan dapat berkuda dan mendaki gunung bromo untuk menikmati keindahan yang menawan saat matahari terbit dan terbenam. Gunung Bromo ini termasuk salah satu cagar biosfer
                yang diakui sebagai anggota “Man and Biosphere Programme” (MAB) UNESCO. Pengakuan tersebut disahkan dalam sidang ke-27 International Co-ordinating Council (ICC) MAB di Kantor Pusat UNESCO Paris.
              </p>
              <br><br><h4><b>4. Taman Nasional Pulau Komodo</b></h4>
              <p>Taman Nasional Komodo awalnya didirikan pada 1980, berlokasi di Kecamatan Komodo, Kabupaten Manggarai, Provinsi Nusa Tenggara Timur. Kemudian, pada 1991, UNESCO telah menetapkan Taman Nasional Komodo sebagai World Heritage Site dan Man and Biosphere Reserve.
                Pada tahun 1977 ditetapkan UNESCO sebagai kawasan Cagar Biosfer (Man and Biosphere Programme - UNESCO), sebagai Situs Warisan Dunia (World Heritage Center - UNESCO) pada tahun 1991, dan sebagai New 7 Wonders of Nature oleh New 7 Wonders Foundation pada tahun 2012.
              </p>
              <br><br><h4><b>5. Labuan Bajo</b></h4>
              <p>Daerah pariwisata, Labuan Bajo, Nusa Tenggara Timur mendapatkan penghargaan sebagai daerah tujuan wisata terfavorit internasional melalui hasil poling Kementerian Pariwisata RI.
                Penghargaan sebagai destinasi wisata terfavorit dunia tersebut diserahkan langsung oleh Menteri Pariwisata.Labuan Bajo mendapat penghargaan itu setelah melalui seleksi yang dilakukan Kementerian Pariwisata dan Ekonomi Kreatif RI dengan melihat semua rekaman-rekaman pariwisata seluruh dunia dan juga pariwisata dan domestik. 
                Labuan Bajo sendiri akhir-akhir ini memang mendapat banyak sekali kunjungan wisatawan baik domestik maupun internasional.
              </p>
              <br><br><h4><b>6. Taman Nasional Way Kambas</b></h4>
              <p>Taman nasional di Indonesia yang satu ini sudah terkenal di seluruh wilayah ASEAN. Taman Nasional Way Kambas berada di Kabupaten Lampung Timur, Provinsi Lampung, dan jadi rumah untuk para gajah sumatera. Di sana, gajah dilatih untuk melakukan banyak hal, termasuk bersosialisasi dengan hewan lain dan juga manusia.
                Tak cuma gajah sumatera, taman nasional di Indonesia ini juga merupakan rumah bagi satwa-satwa langka lainnya seperti badak sumatera, harimau sumatera hingga tapir.
                Taman Nasional Way Kambas pun sudah dinobatkan sebagai Taman Warisan ASEAN (ASEAN Heritage Park). Taman ini merupakan satu dari empat taman nasional di Indonesia yang masuk ke dalam daftar tersebut.
              </p>

            </div>
          </div>
          
        </div>
      </div>
    </div>

    <div class="more-info">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="more-info-content">
              <div class="row">
                <div class="col-md-6">
                  <div class="left-image">
                    <img src="assets/images/sandi.jpg" class="rounded-circle" alt="">
                  </div>
                </div>
                <div class="col-md-6 align-self-center">
                  <div class="right-content">
                    <span>Mari mengenal dia</span>
                    <h2>Siapakah Menteri Pariwisata dan  <em>Ekonomi Kreatif Indonesia RI 2021?</em></h2>
                    <p>Sandiaga Salahuddin Uno atau lebih dikenal dengan nama Sandiaga Uno, dilantik oleh Presiden Joko Widodo sebagai Menteri Pariwisata dan Ekonomi Kreatif/Kepala Badan Pariwisata dan Ekonomi Kreatif pada 23 Desember 2020.
                      Sandiaga Uno meraih gelar akademik Bachelor of Business Administration dari The Wichita State University, Amerika Serikat, dan lulus dengan predikat Summa Cum Laude. Selanjutnya, gelar Master of Business Administration diperolehnya dari The George Washington University, Amerika Serikat.
                      <br><br>Karier politik Sandiaga Uno dimulai saat ia dilantik sebagai Wakil Gubenur DKI periode 2017-2022. Selama menjadi wakil gubernur, ia gencar membuat program-program yang bertujuan menumbuhkan kewirausahaan pada warga Jakarta. Ia juga aktif mendorong DKI Jakarta menjadi destinasi wisata halal.
                      <br><br>Di awal kepemimpinannya di Kementerian Pariwisata dan Ekonomi Kreatif/Badan Pariwisata dan Ekonomi Kreatif, Sandiaga Uno mengusung konsep inovasi, adaptasi, dan kolaborasi.  Inovasi dibutuhkan karena dalam waktu singkat diharuskan ada perubahan yang mendasar dalam pembenahan sektor pariwisata dan ekonomi kreatif. Adaptasi diperlukan mengingat Indonesia dihadapkan dengan pandemi Covid-19 sehingga industri pariwisata dan ekonomi kreatif perlu menerapkan adaptasi kebiasaan baru atau yang juga dikenal dengan Cleanliness, Health, Safety and Environmental Sustainability (CHSE). 
                      Sementara kolaborasi diperlukan karena untuk memulihkan sektor pariwisata dan ekonomi kreatif dibutuhkan keterlibatan semua pihak.</p>
                    
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  

    <br>

    <!-- Footer Starts Here -->
    <div class="sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Copyright &copy; 2021 - Alam Indonesia</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>
<?php } ?>
