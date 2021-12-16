<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
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
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="">
							<?php
								require ("../includes/koneksi.php");

								if(isset($_POST['btnlogin']))
								{
									$user_login = $_POST['username'];
									$pass_login = md5($_POST['password']);

									$sql = "SELECT * FROM akun WHERE username = '{$user_login}' and password = '{$pass_login}'";
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
										$status = $row['status'];
									}

									if($user_login == $user && $pass_login == $pass)
									{
										if($status == 'verified')
										{
											if($clearence == 1)
											{
												header("Location:../admin/admin/dashboard.php");
												$_SESSION['username'] = $user;
												$_SESSION['nama_depan'] = $namad;
												$_SESSION['nama_belakang'] = $namab;
												$_SESSION['email'] = $mail;
												$_SESSION['userType'] = $clearence;
											}
											else{
												header("Location:../user.php");
												$_SESSION['username'] = $user;
												$_SESSION['nama_depan'] = $namad;
												$_SESSION['nama_belakang'] = $namab;
												$_SESSION['email'] = $mail;
												$_SESSION['userType'] = $clearence;
											}
										}
										else{
											$info = "It's look like you haven't still verify your email - $mail";
											$_SESSION['info'] = $info;
											header('location:user-otp.php');
										}
									}
									else{
										$errors['email'] = "Incorrect Username or password!";
									}
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
								}
                            	?>
								</div>

								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control" name="username" value="" required autofocus>
									<div class="invalid-feedback">
										Username is invalid 
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="forgetpassword.php" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block" name="btnlogin">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="register.php">Create One</a>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>