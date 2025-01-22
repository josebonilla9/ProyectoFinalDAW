<?php
include('conection.php');
session_start();

$id = $_POST['id'];

$delete = mysqli_query($conection, "DELETE FROM trades WHERE trade_id = '$id'");

if ($delete == 1) {
    echo '1';
    exit();
} else {
    echo '2';
    exit();
}

mysqli_close($conection);

?>