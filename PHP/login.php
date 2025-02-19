<?php
include("conection.php");

$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];

$query = "SELECT * FROM users WHERE user_name = ? AND user_password = ?";
$stmt = $conection->prepare($query);
$stmt->bind_param("ss", $user_name, $user_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_password'] = $user_password;
    header("Location: ../NAV/home.php");
} else {
    echo 
    '<script>
        alert("Invalid username or password");
        location.href = "../NAV/sign_in.php";
    </script>';
}

mysqli_free_result($login);
$stmt->close();
$conection->close();

?>