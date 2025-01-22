<?php
include ('conection.php');
session_start();

$user_name = $_SESSION['user_name'];

$data = mysqli_query($conection, "SELECT trade_id, trade_date, trade_pl FROM trades WHERE user_name = '$user_name'");

$trades = array();

while($row = mysqli_fetch_assoc($data)){
    $trades[] = $row;
}

mysqli_close($conection);

echo json_encode($trades);
?>