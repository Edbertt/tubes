<?php

    require_once '../includes/koneksi.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="shortcut icon" href="../assets/images/logo.png" type="image/x-icon">

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
							<img src="css/image/images.png" alt="registrasi-berhasil" class="ml-5">
                        <?php

                            echo "<h2> Register Akun Anda Berhasil </h2> <br> ";

							echo "<a href='login.php'><button class='btn btn-primary btn-block'>Login Now</button></a>";
                            
                            $con -> close();
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>