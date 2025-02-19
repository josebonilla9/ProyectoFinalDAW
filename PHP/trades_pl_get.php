<?php
include ('conection.php');
session_start();

$user_name = $_SESSION['user_name'];

$data = $conection->prepare("SELECT trade_id, trade_date, commissions, trade_pl FROM trades WHERE user_name = ?");
$data->bind_param("s", $user_name);
$data->execute();

$result = $data->get_result();

$trades = array();

while($row = $result->fetch_assoc()){
    $trades[] = $row;
}

$conection->close();

echo json_encode($trades);
?>