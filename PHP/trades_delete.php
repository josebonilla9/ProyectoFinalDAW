<?php
include('conection.php');
session_start();

$id = $_POST['id'];

$delete = $conection->prepare("DELETE FROM trades WHERE trade_id = ?");
$delete->bind_param("s", $id);
$delete->execute();

if ($delete->execute()) {
    echo '1';
    exit();
} else {
    echo '2';
    exit();
}

$conection->close();

?>