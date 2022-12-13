<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Methods:PUT');
header('Access-Control-Headers:Access-Control-Headers, 
Content-Type,Access-Control-Allow-Origin,
Access-Control-Methods, Authorization,
 X-Requested-With');


$data=json_decode(file_get_contents('php://input'), true);

$id=$data['id'];
$name=$data['name'];
$uiversity=$data['university'];
$degree=$data['degree'];



include "config.php";
$sql="UPDATE Addstudent SET Student='{$name}' ,University='{$uiversity}',Degree='{$degree}' WHERE Id={$id}";
mysqli_query($conn , $sql);

if(mysqli_query($conn, $sql)){
    echo json_encode(array('message'=>'Student Record Updated', 'status'=>'true'));


}
else{
    echo json_encode(array('message'=>'Student Not Record Updated', 'status'=>'False'));
}
?>