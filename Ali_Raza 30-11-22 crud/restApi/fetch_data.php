<?php

include "config.php"; 

//Headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');

//SQL Query
$sql="SELECT * FROM AddStudent";
$result=mysqli_query($conn, $sql);


if(mysqli_num_rows($result)>0){
    $output=mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);


}
else{
    echo json_encode(array('message'=>'No Record Found', 'status'=>'False'));
}





?>