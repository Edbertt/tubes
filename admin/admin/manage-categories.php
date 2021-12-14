<?php
session_start();
include('../../includes/koneksi.php');
error_reporting(0);
if (strlen($_SESSION['username']) == 0) {
    header('location:../../login/login.php');
} elseif ($_SESSION['userType'] == 0) {
    header('location:../../user.php');
} else {
    if ($_GET['action'] == 'del' && $_GET['rid']) {
        unset($_SESSION['suksesList']);
        $id = intval($_GET['rid']);
        $query = mysqli_query($con, "update kategori set Is_Active='0' where id='$id'");
        // $msg="Kategory dihapus ";
        $_SESSION['suksesList'] = "Kategori dihapus ";
        // echo "<script type='text/javascript'> document.location = 'manage-categories.php'; </script>";
    }
    // Code for restore
    if ($_GET['resid']) {
        unset($_SESSION['suksesList']);
        $id = intval($_GET['resid']);
        $query = mysqli_query($con, "update kategori set Is_Active='1' where id='$id'");
        // $msg="Kategori berhasil direstore";
        $_SESSION['suksesList'] = "Kategori berhasil direstore";
        // echo "<script type='text/javascript'> document.location = 'manage-categories.php'; </script>";
    }

    // Code for Forever deletionparmdel
    if ($_GET['action'] == 'parmdel' && $_GET['rid']) {
        unset($_SESSION['gagalList']);
        $id = intval($_GET['rid']);
        $query = mysqli_query($con, "delete from  kategori  where id='$id'");
        // $delmsg="Kategori dihapus permanen";
        $_SESSION['gagalList'] = "Kategori dihapus permanen";
        // echo "<script type='text/javascript'> document.location = 'manage-categories.php'; </script>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Manage Kategori</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <!-- <link href="assets/css/components.css" rel="stylesheet" type="text/css" /> -->
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
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
                                    <h4 class="page-title">Manage Categories</h4>
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
                                        unset($_SESSION['suksesList']); ?>
                                    </div>
                                <?php } else if (isset($_SESSION['gagalList'])) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $_SESSION['gagalList'];
                                        unset($_SESSION['gagalList']); ?>
                                    </div>
                                <?php } ?>

                                <?php //if($msg){ 
                                ?>
                                <!-- <div class="alert alert-success" role="alert">
<strong>Berhasil!</strong> <?php //echo htmlentities($msg);
                            ?>
</div> -->
                                <?php //} 
                                ?>

                                <?php //if($delmsg){ 
                                ?>
                                <!-- <div class="alert alert-danger" role="alert">
<strong>Selamat Jalan!</strong> <?php //echo htmlentities($delmsg);
                                ?></div> -->
                                <?php //} 
                                ?>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">

                                        <div class="table-responsive">
                                            <table id="category">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kategori</th>
                                                        <th>Deskripsi</th>
                                                        <th>Posting Date</th>
                                                        <th>Last updation Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "Select id,CategoryName,Description,PostingDate,UpdationDate from  kategori where Is_Active=1");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['CategoryName']); ?></td>
                                                            <td><?php echo htmlentities($row['Description']); ?></td>
                                                            <td><?php echo htmlentities($row['PostingDate']); ?></td>
                                                            <td><?php echo htmlentities($row['UpdationDate']); ?></td>
                                                            <td><a href="edit-category.php?cid=<?php echo htmlentities($row['id']); ?>"><i class="fas fa-pencil-alt" style="color: #29b6f6;"></i></a>
                                                                &nbsp;<a href="manage-categories.php?rid=<?php echo htmlentities($row['id']); ?>&&action=del"> <i class="fas fa-trash" style="color: #f05050"></i></a> </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>

                                            </table>
                                        </div>




                                    </div>

                                </div>


                            </div>
                            <!--- end row -->



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">

                                            <h4><i class="fa fa-trash-o"></i> Deleted Categories</h4>

                                        </div>

                                        <div class="table-responsive">
                                            <table id="notactivecategory">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Category</th>
                                                        <th>Description</th>

                                                        <th>Posting Date</th>
                                                        <th>Last updation Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($con, "Select id,CategoryName,Description,PostingDate,UpdationDate from  kategori where Is_Active=0");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['CategoryName']); ?></td>
                                                            <td><?php echo htmlentities($row['Description']); ?></td>
                                                            <td><?php echo htmlentities($row['PostingDate']); ?></td>
                                                            <td><?php echo htmlentities($row['UpdationDate']); ?></td>
                                                            <td><a href="manage-categories.php?resid=<?php echo htmlentities($row['id']); ?>"><i class="ion-arrow-return-right" title="Restore this category"></i></a>
                                                                &nbsp;<a href="manage-categories.php?rid=<?php echo htmlentities($row['id']); ?>&&action=parmdel" title="Delete forever"> <i class="fas fa-trash" style="color: #f05050"></i> </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#category').DataTable();
                                            });

                                            $(document).ready(function() {
                                                $('#notactivecategory').DataTable();
                                            });
                                        </script>



                                    </div>

                                </div>


                            </div>

                        </div> <!-- container -->

                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>

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

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>