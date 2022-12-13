<?php

//Connection
include ('config.php');

//Headers
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: POST');


$data = json_decode(file_get_contents("php://input"),true);

$name = $data['name'];
$university = $data['university'];
$degree = $data['degree'];

//Insert Data
$sql = "INSERT INTO AddStudent (Student,University,Degree) VALUES ('$name','$university','$degree')";

//Condition
if(mysqli_query($conn, $sql)){
    echo json_encode(array('message' => 'Record Enter Succesfully . ' ,'status'=> true));
}
else{
    echo json_encode(array('message' => 'No resord Found. ' ,'status'=>false));
}
?>