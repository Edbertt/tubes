<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="shortcut icon" href="../assets/images/icon.jpg" type="image/x-icon">

	<style>
		body{
			background-image : url("css/image/bg.jpg");
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
		}
	</style>
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="card fat" style="margin: 100px 0px 0px 0px;">
						<div class="card-body">
							<h4 class="card-title">Daftar</h4>
							<form method="POST" action="register.php" class="my-login-validation" novalidate="">
							<?php
								require ("../includes/koneksi.php");

									if(isset($_POST['signup'])){	
    									$namadepan = $_POST['nama_depan'];
    									$namabelakang = $_POST['nama_belakang'];
										$username = $_POST['username'];
    									$password = $_POST['password'];
    									$email = $_POST['email'];
										$nohp = $_POST['no_hp'];
    									$level = 0;

    									$sql = "SELECT * FROM akun WHERE username = '{$username}' or email = '{$email}'";
										$query = mysqli_query($con, $sql);

										while ($row = mysqli_fetch_array($query))
										{
											$namad = $row['nama_depan'];
											$namab = $row['nama_belakang'];
											$user = $row['username'];
											$pass = $row['password'];
											$mail = $row['email'];
        									$hp = $row['no_hp'];
        									$clearence = $row['userType'];
										}

    									if($username == $user)
										{
        									$errors['username'] = "Username has been used!";
    									}
    									if($email == $mail)
    									{
        									$errors['email'] = "Email that you have entered is already exist!";
    									}
    									if(count($errors) === 0)
    									{
        									$encpass = md5($password);
        									$code = rand(999999, 111111);
        									$status = "notverified";
        									$sql1 = "INSERT INTO akun(nama_depan,nama_belakang,username, password, email, no_hp,userType,code,status) VALUES ('$namadepan','$namabelakang','$username', '$encpass', '$email', '$nohp', '$level','$code','$status')";
        									$data_check = mysqli_query($con, $sql1);
        									if($data_check){
            									$subject = "Email Verification Code";
            									$message = "Your verification code is $code";
            									$sender = "From: tumbaltubes1@gmail.com";
            									if(mail($email, $subject, $message, $sender)){
                									$info = "We've sent a verification code to your email - $email";
               										$_SESSION['info'] = $info;
                									$_SESSION['email'] = $email;
                									$_SESSION['password'] = $password;
                									header('location: user-otp.php');
                									exit();
            									}else{
                									$errors['otp-error'] = "Failed while sending code!";
            									}
        									} else{
            									echo "Terjadi Kesalahan : " .$sql. "<br>" .$con->error;
        									}
    									}

									}
								?>
								<?php
									if(count($errors) == 1){
                        		?>
                        			<div class="alert alert-danger text-center">
                            		<?php
                            			foreach($errors as $showerror){
                                			echo $showerror;
                            		}
                            		?>
                        			</div>
                        		<?php
                   					}elseif(count($errors) > 1){
                        			?>
                        			<div class="alert alert-danger">
                            		<?php
                            			foreach($errors as $showerror){
                               			?>
                                		<li><?php echo $showerror; ?></li>
                                	<?php
                            			}
                            			?>
                        			</div>
                        			<?php
									}
                    				?>
								<div class="form-group">
									<label for="nama_depan">Nama Depan</label>
									<input id="nama_depan" type="text" class="form-control" name="nama_depan" required autofocus>
									<div class="invalid-feedback">
										What's your name?
									</div>
								</div>

								<div class="form-group">
									<label for="nama_belakang">Nama Belakang</label>
									<input id="nama_belakang" type="text" class="form-control" name="nama_belakang" required>
									<div class="invalid-feedback">
										What's your name?
									</div>
								</div>

								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control" name="username" required>
									<div class="invalid-feedback">
										What's your username?
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">
										Your email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="number">No HP</label>
									<input id="number" type="number" class="form-control" name="no_hp" required>
									<div class="invalid-feedback">
										Your number is invalid
									</div>
								</div>

								<div class="form-group m-0">
									<input class="btn btn-primary btn-block" type="submit" name="signup" value="Signup">
								</div> 
								<div class="mt-4 text-center">
									Already have an account? <a href="login.php">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						<p style="color:#000000;">Copyright &copy; 2021 &mdash; Alam Indonesia </p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#editakun").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 6
                    },
                    nama_depan: {
                        required: true,
                        minlength: 6
                    },
                    nama_belakang: {
                        required: true,
                        minlength: 6
                    },
					password:{
						minlength : 6
					},
                    email: {
                        required: true,
                        email: true
                    },
                    no_hp: {
                        required: true,
                        minlength: 11
                    }
                },
                messages: {
                    username: {
                        required: "Username harus diisi",
                        minlength: "Username harus setidaknya 6 karakter"
                    },
                    nama_depan: {
                        required: "Masukan nama depan",
                        minlength: "Nama depan harus setidaknya 6 karakter"
                    },
                    nama_belakang: {
                        required: "Masukan nama belakang",
                        minlength: "Nama belakang harus setidaknya 6 karakter"
                    },
					password:{
						minlength : "Password harus memiliki minimal 6 karakter"
					},
                    email: {
                        email: "The email should be in the format: abc@domain.tld"
                    },
                    no_hp: {
                        required: "Masukan no hp",
                        minlength: "Nomor hp harus setidaknya 11 angka"
                    },
                }
            });
        });
    </script> -->
</body>
</html>