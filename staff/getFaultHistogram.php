<?php

class Data{}

include('../connection.php');

$query1 = "SELECT SUBSTRING(Severity, 3,10) as Severity , COUNT(Severity) as totSeverity, ROUND( COUNT(1) / (SELECT COUNT(1) FROM alarm WHERE `Severity` IN ('6 critical', '5 major', '4 minor') AND region_alias !='' ) * 100, 3 ) AS percent  FROM alarm WHERE `Severity` IN ('6 critical', '5 major', '4 minor') AND region_alias !='' GROUP BY Severity ";

$result1 = mysqli_query($dbc, $query1);

if(mysqli_num_rows($result1) > 0){
    while($data1 = mysqli_fetch_array($result1)){
        $myArray1[]=$data1;
    }

    $response = new data();
    $response->success = TRUE;
    $response->message = "Berhasil Mendapatkan Data";
    $response->dataTotal = $myArray1;    
    die(json_encode($response));
}else{
    $response = new data();
    $response->success = FALSE;
    $response->message = "Tidak ada Data";
    die(json_encode($response));
}