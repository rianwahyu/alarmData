<?php 

include('../connection.php');

class Data{}

$query = " SELECT `Probable_Cause`, Count(`Probable_Cause`) as totCause FROM `alarm` WHERE `Probable_Cause` !='' GROUP BY `Probable_Cause` ";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) >= 1) {
    while($data = mysqli_fetch_array($result)){
        $myArray[]=$data;
    }

    $response = new data();
    $response->success = TRUE;
    $response->message = "Berhasil Mendapatkan Data";
    $response->data = $myArray;
    die(json_encode($response));
}else{
    $response = new data();
    $response->success = FALSE;
    $response->message = "Tidak ada Data";
    die(json_encode($response));
}