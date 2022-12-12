
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include ('config.php');
$data = json_decode(file_get_contents("php://input"),true);
$returnData =[];

$email = $data['email'];
$newPassword= password_hash( $data['newPassword'], PASSWORD_BCRYPT);


if(!isset($email) || empty(trim($email)))
{
    $returnData = ( 'Fill all data :');
}
else
{
    $sql = "SELECT * FROM data where email='$email' ";
    $result = mysqli_query($conn, $sql);
    $reset=mysqli_fetch_assoc($result);

    if($email==$reset['email'])
    {
        $sql = "UPDATE data SET password = '$newPassword' WHERE email= '$email' ";
        $result = mysqli_query($conn, $sql);

        $returnData = ( 'Password changed succesfully!.');
    }
    else
    {
        $returnData = ( 'Please enter the correct email!.');
    }
}

echo json_encode($returnData);
?>