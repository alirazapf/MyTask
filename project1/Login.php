<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include ('config.php');
$data = json_decode(file_get_contents("php://input"),true);

$email = $data['email'];
$password= $data['password'];

if ($_SERVER["REQUEST_METHOD"] != "POST") 
{
    $returnData = ('Page Not Found!');
}

elseif(!isset($email) || !isset($password) || empty(trim($email)) || empty(trim($password)))
{
    $returnData = ( 'Please Fill in all Required Fields!.');
}

else
{
    //Email is a unique id.
    $sql = "SELECT * FROM data where email= '$email' ";

    $result=mysqli_query($conn, $sql);
    $res=mysqli_fetch_assoc($result);

    if($email==$res['email'] && password_verify($password,$res['password']))
    {
       
        $returnData = ( 'Congratulations, you are logged in!.');
    }

    else
    {
        $returnData = ( 'No record Found Against this Email.');
    }


}
echo json_encode($returnData);

?>