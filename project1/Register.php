<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'Config.php';
$returnData = [];


$name = $_POST['name'];
$email = $_POST['email'];


$fileName = $_FILES["image"]["name"];
$tempName = $_FILES["image"]["tmp_name"];
$folder = "./image/" . $fileName;
$image = $fileName;
move_uploaded_file($tempName, $folder);
$password = password_hash($_POST['password'],PASSWORD_BCRYPT);

if (!isset($name) || !isset($email) || !isset($password) 
|| empty(trim($name)) || empty(trim($email))|| empty(trim($password)))
    {
        $returnData = ('Please Fill in all Required Fields!');
    }

else{
    $sql = "INSERT INTO data (name,email,image,password) VALUES ('$name','$email','$image','$password')";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        $returnData = ('Register Succesfully.');
    }
    else
    {
        $returnData = ('Email is Already Exits.');
    }
    }
echo json_encode($returnData);
?>
    
