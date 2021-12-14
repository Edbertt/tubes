<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'newsportal';
    $errors = array();

    //Object Oriented
    // $koneksi = new mysqli($host , $user , $pass, $database);

    //prosedural
    $con = mysqli_connect($host , $user , $pass, $database);

    if($con -> connect_error){
        die("Koneksi Gagal: " .$con -> connect_error);
    }
?>