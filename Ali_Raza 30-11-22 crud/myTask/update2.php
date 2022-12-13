<?php

include "connection.php"; 

//Condition
if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($conn , $_POST['id']);
    $name = mysqli_real_escape_string($conn , $_POST['name']);
    $degree = mysqli_real_escape_string($conn , $_POST['degree']);
    $univesity = mysqli_real_escape_string($conn , $_POST['university']);
    $query = "UPDATE AddStudent SET Student = '$name', Degree = '$degree' , University = '$univesity' WHERE Id = '$student_id' ";
    $result= mysqli_query($conn , $query);
    if($result){
        header("location: index.php");
    }
    else{
        echo "error";
    }

}
?>