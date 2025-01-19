<?php
include ('conection.php');
session_start();

$user_name = $_SESSION['user_name'];
$date = $_GET['trade_date'];

$data = mysqli_query($conection, "SELECT user_name, trade_date, instrument, contracts, commissions, trade_pl FROM trades WHERE user_name = '$user_name' AND trade_date = '$date'");

$trades = array();

while($row = mysqli_fetch_assoc($data)){
    $trades[] = $row;
}

mysqli_close($conection);

echo json_encode($trades);
?>