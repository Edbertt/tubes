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
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="newpassword.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    <?php 
                        if(isset($_POST['change-password'])){
                            // $_SESSION['info'] = "";
                            $password = $_POST['password'];
                            $cpassword = $_POST['cpassword'];
                            if($password !== $cpassword){
                                $errors['password'] = "Confirm password not matched!";
                            }else{
                                $code = 0;
                                $email = $_SESSION['email']; //getting this email using session
                                $encpass = md5($password);
                                $update_pass = "UPDATE akun SET code = '{$code}', password = '{$encpass}' WHERE email = '{$email}'";
                                $run_query = mysqli_query($con, $update_pass);
                                if($run_query){
                                    $info = "Your password changed. Now you can login with your new password.";
                                    $_SESSION['info'] = $info;
                                    header('Location: passwordchange.php');
                                }else{
                                    $errors['db-error'] = "Failed to change your password!";
                                }
                            }
                        }
                    ?>

                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
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
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>