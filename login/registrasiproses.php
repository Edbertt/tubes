<?php
    // require_once '../includes/koneksi.php';
    require ("../includes/koneksi.php");

    $namadepan = $_POST['nama_depan'];
    $namabelakang = $_POST['nama_belakang'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'] ,PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $nohp = $_POST['no_hp'];
    $tanggal = $_POST['tanggal_lahir'];
    $level = "user";

    $sql = "SELECT * FROM register WHERE username = '{$username}' or email = '{$email}'";
	$query = mysqli_query($koneksi, $sql);

	while ($row = mysqli_fetch_array($query))
	{
		$namad = $row['nama_depan'];
		$namab = $row['nama_belakang'];
		$user = $row['username'];
		$pass = $row['password'];
		$mail = $row['email'];
        $hp = $row['no_hp'];
        $date = $row['tanggal_lahir'];
        $clearence = $row['level'];
	}

    if($username == $user)
    {
        $errors['username'] = "Username has been used!";
        // header("Location:register.html");
    }
    elseif($email == $mail)
    {
        $errors['email'] = "Email that you have entered is already exist!";
        // header("Location:register.html");
    }
    else
    {
        $code = rand(999999, 111111);
        $status = "notverified";
        $sql1 = "INSERT INTO register(nama_depan,nama_belakang,username, password, email, no_hp, tanggal_lahir,level,code,status) VALUES ('$namadepan','$namabelakang','$username', '$password', '$email', '$nohp', '$tanggal', '$level','$code','$status')";
        $data_check = mysqli_query($koneksi, $sql1);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: raincrew132@gmail.com";
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
            // header("Location:registrasiselesai.php");
        } else{
            echo "Terjadi Kesalahan : " .$sql. "<br>" .$koneksi->error;
        }
    }

                        
?>