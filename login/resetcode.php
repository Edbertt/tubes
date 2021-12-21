<?php require_once "../includes/koneksi.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php
                        if(isset($_POST['check-reset-otp'])){
                            $_SESSION['info'] = "";
                            $otp_code = $_POST['otp'];
                            $check_code = "SELECT * FROM akun WHERE code = $otp_code";
                            $sql = mysqli_query($con, $check_code);
                            if(mysqli_num_rows($sql) > 0){
                                $fetch_data = mysqli_fetch_assoc($sql);
                                $email = $fetch_data['email'];
                                $_SESSION['email'] = $email;
                                $info = "Please create a new password that you don't use on any other site.";
                                $_SESSION['info'] = $info;
                                header('location: newpassword.php');
                                exit();
                            }else{
                                $errors['otp-error'] = "You've entered incorrect code!";
                            }
                        }
                    ?>

                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>