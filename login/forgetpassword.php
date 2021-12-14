<?php require_once "../includes/koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="../assets/images/icon.jpg" type="image/x-icon">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgetpassword.php" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                        if(isset($_POST['check-email'])){
                            $email = $_POST['email'];
                            $check_email = "SELECT * FROM akun WHERE email = '{$email}'";
                            $sql = mysqli_query($con, $check_email);
                            if(mysqli_num_rows($sql) > 0){
                                $code = rand(999999, 111111);
                                $insert_code = "UPDATE akun SET code = $code WHERE email = '{$email}'";
                                $query = mysqli_query($con, $insert_code);
                                if($query){
                                    $subject = "Password Reset Code";
                                    $message = "Your password reset code is $code";
                                    $sender = "From: tumbaltubes1@gmail.com";
                                    if(mail($email, $subject, $message, $sender)){
                                        $info = "We've sent a passwrod reset otp to your email - $email";
                                        $_SESSION['info'] = $info;
                                        $_SESSION['email'] = $email;
                                        header('location: resetcode.php');
                                        exit();
                                    }else{
                                        $errors['otp-error'] = "Failed while sending code!";
                                    }
                                }else{
                                    $errors['db-error'] = "Something went wrong!" .$con -> connect_error;
                                }
                            }else{
                                $errors['email'] = "This email address does not exist!";
                            }
                        }
                    ?>

                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>