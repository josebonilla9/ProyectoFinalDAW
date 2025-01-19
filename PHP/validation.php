<?php 

session_start();

$session = $_SESSION['user_name'];

if ($session == null || $session == '') {
    include("../NAV/sign_out_nav.php");
} else {
    include("../NAV/nav.php");
}

?>