<?php
include('conection.php');
session_start();

$email = $_POST['user_email_form'];
$phone = $_POST['user_phone_form'];
$password = $_POST['user_password_form'];
$new_password = $_POST['user_new_password_form'] ?? null;
$current_password = "";
$id = "";


$user = $_SESSION['user_name'];

$data = mysqli_query($conection, "SELECT * FROM users WHERE user_name = '$user'");

while($row = mysqli_fetch_array($data)){
    $current_password = $row['user_password'];
    $id = $row['user_id'];
}

if($current_password == $password){
    if($new_password == null){
        $update = "UPDATE users SET 
        user_email = '$email', 
        user_phone = '$phone' 
        WHERE user_id = $id";

        echo '1';

        $result = mysqli_query($conection, $update);
        exit;
    } else {
        $update = "UPDATE users SET 
        user_password = '$new_password',
        user_email = '$email', 
        user_phone = '$phone' 
        WHERE user_id = $id";

        echo '1';
        $result = mysqli_query($conection, $update);
        exit;
    }

} else {
    echo '2';
}

mysqli_close($conection);

?>