<?php
session_start();
include('../../includes/koneksi.php');
error_reporting(0);
if (strlen($_SESSION['username']) == 0) {
    header('location:../../login/login.php');
} elseif ($_SESSION['userType'] == 0) {
    header('location:../../user.php');
} else {
    if (isset($_POST['update'])) {
        $judul = $_POST['judul'];
        $catid = $_POST['category'];
        $ringkasan = $_POST['ringkasan'];
        $isiBerita = $_POST['postdescription'];
        $lastuptdby = $_SESSION['username'];
        $arr = explode(" ", $judul);
        $url = implode("-", $arr);
        $status = 1;
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "update berita set judul='$judul',CategoryId='$catid',ringkasan = '$ringkasan',isiBerita='$isiBerita',PostUrl='$url',Is_Active='$status',lastUpdatedBy='$lastuptdby' where id='$postid'");
        if ($query) {
            // unset($_SESSION['suksesList']);
            // $_SESSION['suksesList'] = 'Berita berhasil diupdate';
            // // header('location:manage-posts.php');
            // echo "<script type='text/javascript'> document.location = 'manage-posts.php'; </script>";
            unset($_SESSION['suksesList']);
            $_SESSION['suksesList'] = 'Berita berhasil diupdate';
            header('location:manage-posts.php');
        } else {
            unset($_SESSION['gagalList']);
            $_SESSION['gagalList'] = 'Berita gagal diupdate, Silakan coba Lagi';
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Edit Berita</title>

        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
        <link rel="shortcut icon" href="../../assets/images/icon.jpg" type="image/x-icon">

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Edit Post </h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">

                                <?php if (isset($_SESSION['suksesList'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= $_SESSION['suksesList'];
                                        //unset($_SESSION['suksesList']); ?>
                                    </div>
                                <?php } else if (isset($_SESSION['gagalList'])) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $_SESSION['gagalList'];
                                        unset($_SESSION['gagalList']); ?>
                                    </div>
                                <?php } ?>

                                <!---Success Message--->
                                <?php //if($msg){ 
                                ?>
                                <!-- <div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php //echo htmlentities($msg);
                            ?> -->
                            </div>
                            <?php //} 
                            ?>

                            <!---Error Message--->
                            <?php //if($error){ 
                            ?>
                            <!-- <div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php //echo htmlentities($error);
                            ?></div> -->
                            <?php //} 
                            ?>


                        </div>
                    </div>

                    <?php
                    $postid = intval($_GET['pid']);
                    $query = mysqli_query($con, "select berita.id as postid,berita.PostImage,berita.judul as title,berita.ringkasan,berita.isiBerita,kategori.CategoryName as category,kategori.id as catid from berita left join kategori on kategori.id=berita.CategoryId where berita.id='$postid' and berita.Is_Active=1 ");
                    while ($row = mysqli_fetch_array($query)) {
                        $idberita = $row['postid'];
                        $_SESSION['postid'] = $idberita;
                    ?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Post Title</label>
                                                <input type="text" class="form-control" id="judul" value="<?php echo htmlentities($row['title']); ?>" name="judul" placeholder="Enter title" required>
                                            </div>



                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Category</label>
                                                <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                                    <option value="<?php echo htmlentities($row['catid']); ?>"><?php echo htmlentities($row['category']); ?></option>
                                                    <?php
                                                    // Feching active categories
                                                    $ret = mysqli_query($con, "select id,CategoryName from  kategori where Is_Active=1");
                                                    while ($result = mysqli_fetch_array($ret)) {
                                                    ?>
                                                        <option value="<?php echo htmlentities($result['id']); ?>"><?php echo htmlentities($result['CategoryName']); ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Ringkasan</b></h4>
                                                        <textarea class="summernote" name="ringkasan" required><?php echo htmlentities($row['ringkasan']); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Isi Berita</b></h4>
                                                        <textarea class="summernote" name="postdescription" required><?php echo htmlentities($row['isiBerita']); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Post Image</b></h4>
                                                        <img src="postimages/<?php echo htmlentities($row['PostImage']); ?>" width="300" />
                                                        <br />
                                                        <a href="change-image.php?pid=<?php echo htmlentities($row['postid']); ?>">Update Image</a>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>

                                        <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>

                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                </div> <!-- container -->

            </div> <!-- content -->

            <?php include('includes/footer.php'); ?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        

        <script>
            jQuery(document).ready(function() {

                $('.summernote').summernote({
                    height: 240, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>



    </body>

    </html>
<?php } ?>