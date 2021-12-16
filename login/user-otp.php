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
	<link rel="shortcut icon" href="../assets/images/icon.jpg" type="image/x-icon">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="user-otp.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php
                    if(isset($_POST['check'])){
                        // $_SESSION['info'] = "";
                        $otp_code = $_POST['otp'];
                        $check_code = "SELECT * FROM akun WHERE code = $otp_code";
                        $code_res = mysqli_query($con, $check_code);
                        if(mysqli_num_rows($code_res) > 0){
                            $fetch_data = mysqli_fetch_assoc($code_res);
                            $fetch_code = $fetch_data['code'];
                            $email = $fetch_data['email'];
                            $code = 0;
                            $status = 'verified';
                            $update_otp = "UPDATE akun SET code = $code, status = '$status' WHERE code = $fetch_code";
                            $update_res = mysqli_query($con, $update_otp);
                            if($update_res){
                                $_SESSION['name'] = $name;
                                $_SESSION['email'] = $email;
                                header('location:registrasiselesai.php');
                                exit();
                            }else{
                                $errors['otp-error'] = "Failed while updating code!";
                            }
                        }else{
                            $errors['otp-error'] = "You've entered incorrect code!";
                        }
                    } 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; unset($_SESSION['info']); ?>
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
                        <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>