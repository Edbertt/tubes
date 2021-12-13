<?php
    include("includes/koneksi.php");

    if(strlen($_SESSION['username'])==0)
    { 
      header('location:index.php');
    }
    else{
      if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
      }

      if(isset($_POST['submit'])){
        if (!empty($_POST['csrftoken'])) {
          if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            $comment=$_POST['comment'];
            $namad = $_SESSION['nama_depan'];
            $namab = $_SESSION['nama_belakang'];
            $email = $_SESSION['email'];
            $postid=intval($_GET['nid']);
            $st1='0';
            $query=mysqli_query($con,"insert into komentar(postId,nama_depan,nama_belakang,email,comment,status)
            values('$postid','$namad','$namab','$email','$comment','$st1')");
            if($query){
              echo "<script>alert('Komentar berhasil disubmit. Komentar akan muncul jika diterima Admin ');</script>";
              unset($_SESSION['token']);
            }
            else{
              echo "<script>alert('Komentar gagal. Mohon dicoba lagi.');</script>";  
            }
          }
          
        }
      }
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
    <link rel="shortcut icon" href="assets/images/icon.jpg" type="image/x-icon">

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
              <?php if($_SESSION['userType'] == 1){?>
                <li class="nav-item">
                <a href="#" class="nav-link"> <?= "Halo ";?> <?= $_SESSION['nama_depan']; ?> <?= $_SESSION['nama_belakang'];?> </a>
                </li>
                <li class="nav-item">
                <a href="../admin/admin/dashboard.php" class="nav-link"> Admin Panel </a>
                </li>
                <?php } ?>
                <?php if($_SESSION['userType'] == 0){ ?>
                <li class="nav-item">
                  <a href="#" class="nav-link"> <?= "Halo ";?> <?= $_SESSION['nama_depan']; ?> <?= $_SESSION['nama_belakang'];?> </a>
                </li>
                <?php } ?>
              <li class="nav-item">
                <a class="nav-link" href="../login/logout.php">Logout</a>
              </li>
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
    <?php
        $pid=intval($_GET['nid']);
        $sql = "SELECT * FROM berita WHERE id = '$pid'";
        $query = mysqli_query($con,$sql);

        while($row=mysqli_fetch_array($query)){
    ?>

    <div class="more-info">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="more-info-content">
              <div class="row">
                <div class="col">
                    <p style="color:#a4c639;font-size:40px;"> &nbsp; <?php echo htmlentities($row['judul']);?> </p>
                    <br>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Posting Date: <?php echo htmlentities($row['PostingDate']) ?> | Created By : <?php echo htmlentities($row['posedtBy']) ?></p>
                    <!-- <img src="../admin/admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['judul']);?>"> -->
                    <br>
                    <br>
                    <p> <?php $pt=$row['isiBerita'];
                        echo  (substr($pt,0)); ?> </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php } ?>

    

    <div class="callback-form">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Leave Your <em>Comment</em></h2>
              <span>Name and email is taken from your registration data</span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="contact-form" style="border-radius:0px 0px 0px 0px;">
              <form id="contact" action="" method="post">
              <input hidden type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
                <div class="row"> 
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea name="comment" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="border-button" name="submit">Send Message</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
          </div>
      </div>
    </div>
          
    <div class="callback-form" style="margin-top:0px;">
      <div class="container">
        <div class="row">
          <?php 
            $sts=1;
            $query=mysqli_query($con,"select nama_depan,nama_belakang,comment,postingDate from  komentar where postId='$pid' and status='$sts'");
            while ($row=mysqli_fetch_array($query)) {
          ?>
    
          <div class="col-md-12">
            <div class="contact-form" style="border-radius:0px 0px 0px 0px;">
                <div class="row"> 
                  <div class="col-lg-12" align="left">
                  <h5 class="mt-0"><?php echo htmlentities($row['nama_depan']);?> <?=" ";?> <?php echo htmlentities($row['nama_belakang']);?>  <br />
                  <span style="font-size:11px;"><b>at</b> <?php echo htmlentities($row['postingDate']);?></span>
                  </h5>
                  <?php echo htmlentities($row['comment']);?> 
                  </div>
                </div>
            </div>
          </div>
    <?php } ?>
    </div>
      </div>
    </div>
    <br>

    <!-- Footer Starts Here -->
    <div class="sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Copyright &copy; 2021</p>
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