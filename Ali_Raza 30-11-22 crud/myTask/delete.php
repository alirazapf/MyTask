<?php
//Connection
session_start();
include "connection.php"; 

//Getting ID
$id = $_GET['sid']; 
echo $id ;

//Delete Query
$query = "DELETE FROM AddStudent WHERE Id = $id " ;
$result= mysqli_query($conn , $query);

//Checking
if($result){
    header("location: index.php");
}
else{
    echo "error";
}
?>