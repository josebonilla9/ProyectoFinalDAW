<?php
include('conection.php');
session_start();

$instrument = $_POST['trade_instrument'];
$contracts = $_POST['trade_contracts'];
$commissions = $_POST['trade_commissions'];
$trade_pl = $_POST['trade_pl'];
$date = $_POST['trade_date'];

$commissions = number_format((float)$commissions, 2, '.', '');
$trade_pl = number_format((float)$trade_pl, 2, '.', '');

$user_name = $_SESSION['user_name'];

$insert = mysqli_query($conection, "INSERT INTO trades (user_name, trade_date, instrument, contracts, commissions, trade_pl) VALUES ('$user_name', '$date', '$instrument', '$contracts', '$commissions', '$trade_pl')");

if ($insert == 1) {
    echo '1';
    exit();
} else {
    echo '2';
    exit();
}

mysqli_close($conection);

?>