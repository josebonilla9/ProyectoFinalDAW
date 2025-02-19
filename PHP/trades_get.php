<?php
include ('conection.php');
session_start();

$user_name = $_SESSION['user_name'];
$date = $_GET['trade_date'];

$data = $conection->prepare("SELECT trade_id, user_name, trade_date, instrument, contracts, commissions, trade_pl FROM trades WHERE user_name = ? AND trade_date = ?");
$data->bind_param("ss", $user_name, $date);
$data->execute();

$result = $data->get_result();

$trades = array();

while($row = $result->fetch_assoc()){
    $trades[] = $row;
}

$conection->close();

echo json_encode($trades);
?>