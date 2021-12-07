<?php
session_start();
include('../../includes/koneksi.php');
error_reporting(0);
if(strlen($_SESSION['username'])==0)
  { 
header('location:../../login/login.php');
}
else{

// Code for Forever deletionparmdel
if($_GET['action']=='del' && $_GET['rid'])
{
	$id=intval($_GET['rid']);
	$query=mysqli_query($con,"delete from  akun  where id=$id");
    echo "<script>alert('Akun berhasil dihapus.');</script>";
    echo "<script type='text/javascript'> document.location = 'manage-subadmins.php'; </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title> | Manage Subadmins</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <!-- <link href="assets/css/components.css" rel="stylesheet" type="text/css" /> -->
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
<?php include('includes/topheader.php');?>

            <!-- ========== Left Sidebar Start ========== -->
<?php include('includes/leftsidebar.php');?>
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
                                    <h4 class="page-title">Manage Akun</h4>
                                    <div class="clearfix"></div>
                                    <br>
                                    <?php if (isset($_SESSION['suksesList'])) { ?>
<div class="alert alert-success" role="alert">
  <?=$_SESSION['suksesList']; unset($_SESSION['suksesList']); ?>
</div>
<?php }else if(isset($_SESSION['gagalList'])){ ?>
<div class="alert alert-danger" role="alert">
  <?=$_SESSION['gagalList']; unset($_SESSION['gagalList']); ?>
</div>
<?php } ?>
                                </div>
							</div>
						</div>
                        <!-- end row -->
                                    
    <div class="row">
										<div class="col-md-12">
											<div class="demo-box m-t-20">
												<div class="table-responsive">
                                                    <table id="listakun">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Nama Depan</th>
                                                                <th>Nama Belakang</th>
                                                                <th>Email</th>
                                                                <th>Level</th>
                                                                <th>No hp</th>
                                                                <th>Creation Date</th>
                                                                <th>Last updation Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$query=mysqli_query($con,"Select * from  akun");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>

 <tr>
<th><?php echo htmlentities($cnt);?></th>
<th><?php echo htmlentities($row['AdminUserName']);?></th>
<th><?php echo htmlentities($row['nama_depan']);?></th>
<th><?php echo htmlentities($row['nama_belakang']);?></th>
<th><?php echo htmlentities($row['AdminEmailId']);?></th>
<th><?php echo htmlentities($row['userType']);?></th>
<th><?php echo htmlentities($row['no_hp']);?></th>
<th><?php echo htmlentities($row['CreationDate']);?></th>
<th><?php echo htmlentities($row['UpdationDate']);?></th>
<th><a href="edit-subadmin.php?said=<?php echo htmlentities($row['id']);?>"><i class="fas fa-pencil-alt" style="color: #29b6f6;"></i></a> 
	&nbsp;<a class="confirmation" href="manage-subadmins.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> <i class="fas fa-trash" style="color: #f05050"></i></a> </th>
</tr>
<?php
$cnt++;
 } ?>
</tbody>
                                                  
                                                    </table>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {
                                                    $('#listakun').DataTable();
                                                    } );
                                                </script>



											</div>

										</div>

							
									</div>
                                    <!--- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
<?php include('includes/footer.php');?>
            </div>

        </div>
        <!-- END wrapper -->

        <script>
            var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }

    // tooltip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

        </script>                                            

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <!-- <script src="assets/js/jquery.min.js"></script> -->
        <!-- <script src="assets/js/jquery-3.6.0.min.js"></script> -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
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

