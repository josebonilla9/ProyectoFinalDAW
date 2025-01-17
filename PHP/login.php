<?php

include("conection.php");

$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];

$login = mysqli_query($conection, "SELECT * FROM users WHERE user_name = '$user_name' AND user_password = '$user_password'");

if (mysqli_num_rows($login) > 0) {
    session_start();
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_password'] = $user_password;
    header("Location: ../NAV/home.php");
} else {
    echo 
    '<script>
        alert("User not found");
        location.href = "../NAV/sign_in.php";
    </script>';
}

mysqli_free_result($login);
mysqli_close($conection);

?>