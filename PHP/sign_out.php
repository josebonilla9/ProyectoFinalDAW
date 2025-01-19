<?php

session_start();
session_destroy();
header("Location: ../NAV/sign_in.php");

?>