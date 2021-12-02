<?php
    require "../includes/koneksi.php";

    $user = $_SESSION['username'];
    $email = $_SESSION['email'];
    $postid = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <?php
            if(isset($_POST['comment'])){
                $komentar = $_POST['pesan'];
                date_default_timezone_set('Asia/Jakarta');
                $current_timezone = date_default_timezone_get();
                $date = date("Y-m-d H:i:s");

                $sql1 = "SELECT * FROM register WHERE username = '{$user}' and email = '{$email}' ";
                $query1 = mysqli_query($koneksi, $sql1);
      			$data1 = mysqli_fetch_array ($query1);

                if($query1 = mysqli_query($koneksi, $sql1)){
                    while ($data1 = mysqli_fetch_array ($query1)) {
                        $username = $data1['username'];
                        $mail = $data1['email'];
                    }
                    if($user == $username && $email == $mail)
                    {
                        $sql2 = "INSERT INTO komentar(postid,username,email,komentar,date) VALUES('$postid','$user' , '$email', '$komentar', '$date')";
                        mysqli_query($koneksi, $sql2);
                    }
                }
                
            }
        ?>
        <div class="field">
            <textarea name="pesan" id="pesan" rows="3" placeholder="Pesan Kamu..."></textarea>
        </div>

        <ul class="actions">
            <li><input type="submit" value="submit" class="primary" name="comment" /></li>
        </ul>
    </form>
        
        <?php
            $sql3 = "SELECT * FROM komentar WHERE postid = '$postid' and status = '1'";

            if($query3 = mysqli_query($koneksi, $sql3)){
            while ($data3 = mysqli_fetch_object ($query3)) {
                    echo $data3 -> username;
                    echo " ";
                    echo $data3 -> date;
                    echo "<br>" ;
                    echo $data3 -> email;
                    echo "<br>";
                    echo $data3 -> komentar;
                    echo "<br>";
                }
            }
        ?>
</body>
</html>