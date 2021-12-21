<?php
session_start();
include('../../includes/koneksi.php');
error_reporting(0);
if (strlen($_SESSION['username']) == 0) {
    header('location:../../login/login.php');
} elseif ($_SESSION['userType'] == 0) {
    header('location:../../user.php');
} else {

    if ($_GET['action'] == 'restore') {
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "update berita set Is_Active=1 where id='$postid'");
        if ($query) {
            // $msg="Post restored successfully ";
            unset($_SESSION['suksesList']);
            $_SESSION['suksesList'] = 'Berita berhasil direstore';
            header('location:manage-posts.php');
        } else {
            $error = "Terjadi Kesalahan. Mohon dicoba lagi";
        }
    }


    // Code for Forever deletionparmdel
    if ($_GET['presid']) {
        $id = intval($_GET['presid']);
        $query = mysqli_query($con, "delete from  berita  where id='$id'");
        // $delmsg="Berita dihapus permanen";
        unset($_SESSION['gagalList']);
        $_SESSION['gagalList'] = 'Berita dihapus permanen';
        // echo "<script type='text/javascript'> document.location = 'trash-posts.php'; </script>";
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
        <title>Recycle Bin</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="../plugins/morris/morris.css">

        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <!-- <link href="assets/css/components.css" rel="stylesheet" type="text/css" /> -->
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <link rel="shortcut icon" href="../../assets/images/icon.jpg" type="image/x-icon">


        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>


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
                                    <h4 class="page-title">Trashed Posts </h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-6">

                                <?php if (isset($_SESSION['suksesHapus'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= $_SESSION['suksesHapus'];
                                        unset($_SESSION['suksesHapus']); ?>
                                    </div>
                                <?php } else if (isset($_SESSION['gagalList'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['gagalList'];
                                unset($_SESSION['gagalList']); ?>
                            </div>
                        <?php } ?>

                                <?php //if($delmsg){ 
                                ?>
                                <!-- <div class="alert alert-danger" role="alert">
<strong>Berhasil!</strong> <?php //echo htmlentities($delmsg);
                            ?></div> -->
                                <?php //} 
                                ?>


                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">


                                        <div class="table-responsive">
                                            <table id="beritasampah">
                                                <thead>
                                                    <tr>

                                                        <th>Judul</th>
                                                        <th>Kategori</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $query = mysqli_query($con, "select berita.id as postid,berita.judul as title,kategori.CategoryName as category from berita left join kategori on kategori.id=berita.CategoryId where berita.Is_Active=0 ");
                                                    // $rowcount=mysqli_num_rows($query);

                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <td><b><?php echo htmlentities($row['title']); ?></b></td>
                                                            <td><?php echo htmlentities($row['category']) ?></td>

                                                            <td>
                                                                <a href="trash-posts.php?pid=<?php echo htmlentities($row['postid']); ?>&&action=restore" onclick="return confirm('Do you really want to restore ?')"> <i class="ion-arrow-return-right" title="Restore this Post"></i></a>
                                                                &nbsp;
                                                                <a href="trash-posts.php?presid=<?php echo htmlentities($row['postid']); ?>&&action=perdel" onclick="return confirm('Do you really want to delete ?')"><i class="fas fa-trash" style="color: #f05050" title="Permanently delete this post"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#beritasampah').DataTable();
                                });
                            </script>


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
            <!-- <script src="assets/js/jquery.min.js"></script> -->
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="../plugins/switchery/switchery.min.js"></script>

            <!-- CounterUp  -->
            <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
            <script src="../plugins/counterup/jquery.counterup.min.js"></script>

            <!--Morris Chart-->
            <script src="../plugins/morris/morris.min.js"></script>
            <script src="../plugins/raphael/raphael-min.js"></script>

            <!-- Load page level scripts-->
            <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
            <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
            <script src="../plugins/jvectormap/gdp-data.js"></script>
            <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>


            <!-- Dashboard Init js -->
            <script src="assets/pages/jquery.blog-dashboard.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>