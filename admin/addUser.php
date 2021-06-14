<?php

include '../connection.php';

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == getUsername($username)) {
    echo json_encode(array(
        "status" => false,
        "message" => "Username sudah ada, mogon menggunakan username lain"
    ));
} else {
    $query = "INSERT INTO `user`(`name`, `username`, `password`) VALUES ('$name', '$username', '$password')";
    $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
    if ($result == true) {
        echo json_encode(array(
            "status" => true,
            "message" => "Sukses Tambah !"
        ));
    } else {
        echo json_encode(array(
            "status" => false,
            "message" => "Gagal Tambah !"
        ));
    }
}


function getUsername($username)
{
    include '../connection.php';
    $sql = "SELECT username FROM user WHERE username='$username'";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        return "not found";
    } else {
        return $data['username'];
    }
    mysqli_close($dbc);
}
