<?php

//Headers
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: DELETE');

//Connection
include ('config.php');


//Get Data
$data = json_decode(file_get_contents("php://input"),true);
$student_id = $data['id'];

//SQL Query
$sql = "DELETE FROM AddStudent WHERE Id='$student_id' ";

//Check Query
if(mysqli_query($conn, $sql)){
    echo json_encode(array('message' => 'Record Deleted Succesfully . ' ,'status'=> true));
}
else{
    echo json_encode(array('message' => 'Error. ' ,'status'=>false));
}
?>