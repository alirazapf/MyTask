
<?php

use LDAP\Result;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include ('config.php');

$data = json_decode(file_get_contents("php://input"),true);
$returnData = [];
$email = $data['email'];
$password= $data['password'];
//$newPassword = $data['newPassword'];
$newPassword = password_hash($data['newpassword'],PASSWORD_BCRYPT);

if(!isset($email) || empty(trim($email)))
{
    $returnData = ( 'Please Fill in all Required Fields!.');
}
else
{
    $sql = "SELECT * FROM data where email='$email' ";
    $result = mysqli_query($conn, $sql);
    $res=mysqli_fetch_assoc($result);

    if($email==$res['email'] && password_verify($password,$res['password']))
    {
        $sql = "UPDATE data SET password='$newPassword' WHERE email='$email' ";

        $result = mysqli_query($conn, $sql);

        if($result)
        {
            $returnData = ( 'You have successfully reset.');
        }
        

    }
    else
    {
        $returnData = ( 'Please enter the correct email and password.');

    }


}

echo json_encode($returnData);
?>