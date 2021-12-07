<?php
session_start();
include('../../includes/koneksi.php');
error_reporting(0);
if(strlen($_SESSION['username'])==0)
  { 
header('location:../../login/login.php');
}
else{
if( $_GET['disid'])
{
    unset($_SESSION['suksesList']);
	$id=intval($_GET['disid']);
	$query=mysqli_query($con,"update komentar set status='0' where id='$id'");
	// $msg="Komentar diunapprove ";
    $_SESSION['suksesList'] = "Komentar diunapprove ";
    // echo "<script type='text/javascript'> document.location = 'manage-comments.php'; </script>";
}
// Code for restore
if($_GET['appid'])
{
    unset($_SESSION['suksesList']);
	$id=intval($_GET['appid']);
	$query=mysqli_query($con,"update komentar set status='1' where id='$id'");
	// $msg="Komentar diapproved";
    $_SESSION['suksesList'] = "Komentar diapprove ";
    // echo "<script type='text/javascript'> document.location = 'manage-comments.php'; </script>";
}

// Code for deletion
if($_GET['action']=='del' && $_GET['rid'])
{
    unset($_SESSION['suksesList']);
	$id=intval($_GET['rid']);
	$query=mysqli_query($con,"delete from  komentar  where id='$id'");
	// $delmsg="Komentar dihapus permanen";
    $_SESSION['suksesHapus'] = "Komentar dihapus permanen ";
    // echo "<script type='text/javascript'> document.location = 'manage-comments.php'; </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title> | Manage Cooments</title>
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
        <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>

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
                                    <h4 class="page-title">Manage Approved Comments</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->


<div class="row">
<div class="col-sm-6">  
 
<?php if (isset($_SESSION['suksesList'])) { ?>
<div class="alert alert-success" role="alert">
  <?=$_SESSION['suksesList']; unset($_SESSION['suksesList']); ?>
</div>
<?php }else if(isset($_SESSION['suksesHapus'])){ ?>
<div class="alert alert-danger" role="alert">
  <?=$_SESSION['suksesHapus']; unset($_SESSION['suksesHapus']); ?>
</div>
<?php } ?>
 
<?php //if($msg){ ?>
<!-- <div class="alert alert-success" role="alert">
<strong>Berhasil!</strong> <?php //echo htmlentities($msg);?>
</div> -->
<?php //} ?>

<?php //if($delmsg){ ?>
<!-- <div class="alert alert-danger" role="alert">
<strong>Berhasil!</strong> <?php //echo htmlentities($delmsg);?></div> -->
<?php //} ?>


</div>

                                    <div class="row">
										<div class="col-md-12">
											<div class="demo-box m-t-20">

												<div class="table-responsive">
                                                    <table id="approvedcomment">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Email</th>
                                                                <th width="300">Komentar</th>
                                                                <th>Status</th>
                                                                <th>Berita</th>
                                                                <th>Posting Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$query=mysqli_query($con,"Select komentar.id,  komentar.name,komentar.email,komentar.postingDate,komentar.comment,berita.id as postid,berita.PostTitle from  komentar join berita on berita.id=komentar.postId where komentar.status=1");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>

<tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo htmlentities($row['name']);?></td>
<td><?php echo htmlentities($row['email']);?></td>
<td><?php echo htmlentities($row['comment']);?></td>
<td><?php $st=$row['status'];
if($st==0):
echo "Wating for approval";
else:
echo "Approved";
endif;
?></td>


<td><a href="edit-post.php?pid=<?php echo htmlentities($row['postid']);?>"><?php echo htmlentities($row['PostTitle']);?></a> </td>
<td><?php echo htmlentities($row['postingDate']);?></td>
<td>
<?php if($st==0):?>
    <a href="manage-comments.php?disid=<?php echo htmlentities($row['id']);?>" title="Disapprove this comment"><i class="ion-arrow-return-right" style="color: #29b6f6;"></i></a> 
<?php else :?>
  <a href="manage-comments.php?appid=<?php echo htmlentities($row['id']);?>" title="Approve this comment"><i class="ion-arrow-return-right" style="color: #29b6f6;"></i></a> 
<?php endif;?>

	&nbsp;<a href="manage-comments.php?rid=<?php echo htmlentities($row['id']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')"> <i class="fas fa-trash" style="color: #f05050"></i></a> </td>
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


 </div>
                            
											</div>

										</div>

                                        <script>
                                            $(document).ready(function() {
                                                $('#approvedcomment').DataTable();
                                            } );
                                        </script>
							
									</div>                  
                                  
                    </div> <!-- container -->

                </div> <!-- content -->
<?php include('includes/footer.php');?>
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