<?php

include("conection.php");

$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
$user_password = $_POST['user_password'];

$query = "SELECT user_name, user_email, user_phone FROM users WHERE user_name = ? OR user_email = ? OR user_phone = ?";
$stmt = $conection->prepare($query);
$stmt->bind_param("sss", $user_name, $user_email, $user_phone);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if ($row['user_name'] === $user_name) {
        echo '<script>
            alert("This user is already registered");
            location.href = "../NAV/sign_up.php";
        </script>';
        exit;
    }
    if ($row['user_email'] === $user_email) {
        echo '<script>
            alert("This email is already registered");
            location.href = "../NAV/sign_up.php";
        </script>';
        exit;
    }
    if ($row['user_phone'] === $user_phone) {
        echo '<script>
            alert("This phone is already registered");
            location.href = "../NAV/sign_up.php";
        </script>';
        exit;
    }
}

$insertQuery = "INSERT INTO users (user_name, user_password, user_email, user_phone, user_role, initial_balance) VALUES (?, ?, ?, ?, 'client', 0)";
$insertStmt = $conection->prepare($insertQuery);
$insertStmt->bind_param("ssss", $user_name, $user_password, $user_email, $user_phone);
$insertSuccess = $insertStmt->execute();

if ($insertSuccess) {
    echo '<script>
        alert("User registered successfully");
        location.href = "../NAV/sign_in.php";
    </script>';
} else {
    echo '<script>
        alert("Error registering user");
        location.href = "../NAV/sign_up.php";
    </script>';
}

$stmt->close();
$insertStmt->close();
$conection->close();

?>