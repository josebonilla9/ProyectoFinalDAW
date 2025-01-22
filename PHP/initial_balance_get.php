<?php
include ('conection.php');
session_start();

$user_name = $_SESSION['user_name'];

$result = mysqli_query($conection, "SELECT initial_balance FROM users WHERE user_name = '$user_name'");


$result = mysqli_query($conection, "SELECT initial_balance FROM users WHERE user_name = '$user_name'");

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    echo json_encode([$row]);
}

mysqli_close($conection);
?>