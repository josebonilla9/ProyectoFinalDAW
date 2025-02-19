<?php
include ('conection.php');
session_start();

$user_name = $_SESSION['user_name'];

$result = $conection->prepare("SELECT initial_balance FROM users WHERE user_name = ?");
$result->bind_param("s", $user_name);
$result->execute();

$data = $result->get_result();

if ($result) {
    $row = $data->fetch_assoc();
    
    echo json_encode([$row]);
}

$conection->close();

?>