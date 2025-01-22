<?php

include("conection.php");

$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
$user_password = $_POST['user_password'];

$user_verification = mysqli_num_rows(mysqli_query($conection, "SELECT * FROM users WHERE user_name = '$user_name'"));

if ($user_verification > 0) {
    echo 
    '<script>
        alert("This user is already registered");
        location.href = "../NAV/sign_up.php";
    </script>';
    exit;
}

$email_verification = mysqli_num_rows(mysqli_query($conection, "SELECT * FROM users WHERE user_email = '$user_email'"));

if ($email_verification > 0) {
    echo 
    '<script>
        alert("This email is already registered");
        location.href = "../NAV/sign_up.php";
    </script>';
    exit;
}

$phone_verification = mysqli_num_rows(mysqli_query($conection, "SELECT * FROM users WHERE user_phone = '$user_phone'"));

if ($phone_verification > 0) {
    echo 
    '<script>
        alert("This phone is already registered");
        location.href = "../NAV/sign_up.php";
    </script>';
    exit;
}

$insert = mysqli_query($conection, "INSERT INTO users (user_name, user_password, user_email, user_phone, user_role, initial_balance) VALUES ('$user_name', '$user_password', '$user_email', '$user_phone', 'client', 0)");

if ($insert) {
    echo 
    '<script>
        alert("User registered successfully");
        location.href = "../NAV/sign_in.php";
    </script>';
} else {
    echo 
    '<script>
        alert("Error registering user");
        location.href = "../NAV/sign_up.php";
    </script>';
}

mysqli_close($conection);

?>