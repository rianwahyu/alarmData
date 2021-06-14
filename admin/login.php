<?php

class usr
{
}


include('../connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM `administrator` WHERE username='$username' AND password='$password'  ";
$result = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
$row = mysqli_fetch_array($result);
if (!empty($row)) {
    $response = new usr();
    $response->success = TRUE;
    $response->message = "Selamat Datang Admin ";
    $response->id = $row['id'];
    $response->access = 'Admin';
    die(json_encode($response));
} else {
    $response = new usr();
    $response->success = FALSE;
    $response->message = "Akun tidak ditemukan, mohon periksa kembali email dan password anda";
    die(json_encode($response));
}

mysqli_close($dbc);
