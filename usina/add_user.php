<?php

include ('conexao.php');

$username = $_POST['name'];
$email = $_POST['mobile'];
$mobile = $_POST['email'];
$city = $_POST['city'];

$sql = "INSERT INTO `users` (`username`,`mobile`,`email`,`city`) values ('$username', '$mobile', '$email', '$city' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>

