<?php


echo "Welcome <br>";

include "connection.php";


    //Assigning values

    $name = $_POST['name'];
    $degree = $_POST['degree'];
    $university = $_POST['university'];
    $cgpa = $_POST['cgpa'];
    $course = $_POST['course'];

    //Insert data into tables

    $sql = "INSERT INTO `AddStudent` ( `Student`, `Degree`, `University`) VALUES ('{$name}', '{$degree}', '{$university}') ";
    $sql2 = "INSERT INTO `CGPA` ( `gpa`) VALUES ('{$cgpa}') ";
    $sql3 = "INSERT INTO `scourse` ( `course`) VALUES ('{$course}') ";

    //Run Quriess
    
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql2);
    mysqli_query($conn, $sql3);













?>
