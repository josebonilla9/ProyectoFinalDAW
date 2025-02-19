<?php
include('conection.php');
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$instrument = $_POST['trade_instrument'];
$contracts = $_POST['trade_contracts'];
$commissions = $_POST['trade_commissions'];
$trade_pl = $_POST['trade_pl'];
$date = $_POST['trade_date'];

$commissions = number_format((float)$commissions, 2, '.', '');
$trade_pl = number_format((float)$trade_pl, 2, '.', '');

$user_name = $_SESSION['user_name'] ?? null;

$insert = $conection->prepare("INSERT INTO trades (user_name, trade_date, instrument, contracts, commissions, trade_pl) VALUES (?, ?, ?, ?, ?, ?)");

$insert->bind_param("ssssdd", $user_name, $date, $instrument, $contracts, $commissions, $trade_pl);
$insert->execute();

if ($insert->affected_rows > 0) {
    echo '1';
    exit();
} else {
    echo '2';
    exit();
}

$insert->close();
$conection->close();

?>