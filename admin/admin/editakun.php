<?php
session_start();
include('../../includes/koneksi.php');
error_reporting(0);
if (strlen($_SESSION['username']) == 0) {
    header('location:../../login/login.php');
} elseif ($_SESSION['userType'] == 0) {
    header('location:../../user.php');
} else {
    if (isset($_POST['submit'])) {
        $aid = intval($_GET['said']);
        $username = $_POST['username'];
        $namad = $_POST['namadepan'];
        $namab = $_POST['namabelakang'];
        $email = $_POST['emailid'];
        $nohp = $_POST['nohp'];
        $query = mysqli_query($con, "Update akun set username='$username', nama_depan='$namad', nama_belakang='$namab', email='$email', no_hp='$nohp'  where id='$aid'");
        if ($query) {
            unset($_SESSION['suksesList']);
            $_SESSION['suksesList'] = 'List berhasil diupdate!';
            header('location:manageakun.php');
        } else {
            echo "<script>alert('Terjadi Kesalahan . Mohon dicoba lagi.');</script>";
        }
    }


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Edit Akun</title>

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
        <link rel="stylesheet" href="../../assets/css/error.css">


    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Edit Subadmin</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Edit Subadmin </b></h4>
                                    <hr />



                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!---Success Message--->
                                            <?php //if($msg){ 
                                            ?>
                                            <!-- <div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php //echo htmlentities($msg);
                            ?>
</div> -->
                                            <?php //} 
                                            ?>

                                            <!---Error Message--->
                                            <?php if ($error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Gagal!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>


                                        </div>
                                    </div>

                                    <?php
                                    $aid = intval($_GET['said']);
                                    $query = mysqli_query($con, "Select * from  akun where id='$aid'");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>




                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal needs-validation" name="suadmin" method="post" id="editakun" novalidate>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label form-label" for="username">Username</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="username" class="form-control" value="<?php echo htmlentities($row['username']); ?>" name="username" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Nama Depan</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="namad" class="form-control" value="<?php echo htmlentities($row['nama_depan']); ?>" name="namadepan" required>
                                                            <div id="validasi-namad"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Nama Belakang</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="namab" class="form-control" value="<?php echo htmlentities($row['nama_belakang']); ?>" name="namabelakang" required>
                                                            <div id="validasi-namab"></div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Email id</label>
                                                        <div class="col-md-10">
                                                            <input type="email" id="email" class="form-control" value="<?php echo htmlentities($row['email']); ?>" name="emailid" required>
                                                            <div id="validasi-email"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">No Hp</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="nohp" class="form-control" value="<?php echo htmlentities($row['no_hp']); ?>" name="nohp" required>
                                                            <div id="validasi-nohp"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Creation Date</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="cdate" class="form-control" value="<?php echo htmlentities($row['CreationDate']); ?>" name="cdate" required readonly>
                                                            <div id="validasi-cdate"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Updation date</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="udate" class="form-control" value="<?php echo htmlentities($row['UpdationDate']); ?>" name="udate" readonly>
                                                            <div id="validasi-udate"></div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">

                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>

                                                </form>
                                            </div>


                                        </div>


                                </div>
                            </div>
                        </div>
                        <!-- end row -->


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
        <script src="assets/js/jquery.min.js"></script>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#editakun").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 5
                    },
                    namadepan: {
                        required: true,
                        minlength: 3
                    },
                    namabelakang: {
                        required: true,
                        minlength: 3
                    },
                    emailid: {
                        required: true,
                        email: true
                    },
                    nohp: {
                        required: true,
                        minlength: 9
                    }
                },
                messages: {
                    username: {
                        required: "Username harus diisi",
                        minlength: "Username harus setidaknya 5 karakter"
                    },
                    namadepan: {
                        required: "Masukan nama depan",
                        minlength: "Nama depan harus setidaknya 3 karakter"
                    },
                    namabelakang: {
                        required: "Masukan nama belakang",
                        minlength: "Nama belakang harus setidaknya 3 karakter"
                    },
                    emailid: {
                        required : "Masukkan Emailmu",
                        email: "The email should be in the format: abc@domain.tld"
                    },
                    nohp: {
                        required: "Masukan no hp",
                        minlength: "Nomor hp harus setidaknya 9 angka"
                    },
                }
            });
        });
    </script>

    </body>

    </html>
<?php } ?>