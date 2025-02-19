<?php
include('conection.php');
session_start();

$email = $_POST['user_email_form'];
$phone = $_POST['user_phone_form'];
$initial_balance = $_POST['user_initial_balance_form'];
$password = $_POST['user_password_form'];
$new_password = $_POST['user_new_password_form'] ?? null;
$current_password = "";
$id = "";

$user = $_SESSION['user_name'];

$data = $conection->prepare("SELECT * FROM users WHERE user_name = ?");
$data->bind_param("s", $user, $date);
$data->execute();

$dataResult = $data->get_result();

while($row = $dataResult->fetch_assoc()){
    $current_password = $row['user_password'];
    $id = $row['user_id'];
}

if($current_password == $password){
    if($new_password == null){
        $update = "UPDATE users SET 
        user_email = '$email', 
        user_phone = '$phone', 
        initial_balance = '$initial_balance'
        WHERE user_id = $id";

        echo '1';

        $result = mysqli_query($conection, $update);
        exit;
    } else {
        $update = "UPDATE users SET 
        user_password = '$new_password',
        user_email = '$email', 
        user_phone = '$phone', 
        initial_balance = '$initial_balance'
        WHERE user_id = $id";

        echo '1';
        $result = mysqli_query($conection, $update);
        exit;
    }

} else {
    echo '2';
}

$conection->close();

?>