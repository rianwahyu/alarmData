<?php

class Data{}

include('../connection.php');

$query = "SELECT * FROM ( 
    SELECT RIGHT(region_alias,1) reg, COUNT(IF( Severity= '6 critical', 1, null)) as cri, COUNT(IF( Severity= '5 major', 1, null)) as maj, COUNT(IF( Severity= '4 minor', 1, null)) as min FROM alarm WHERE `Severity` IN ('6 critical', '5 major', '4 minor') AND region_alias !='' GROUP BY `region_alias` ) a ORDER BY reg ASC";

$result = mysqli_query($dbc, $query);

if(mysqli_num_rows($result) > 0){
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