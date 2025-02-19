<?php
include ('conection.php');
session_start();

$password = "";

$password_delete = $_POST['user_password_delete'];
$password_delete_rpt = $_POST['user_password_delete_rpt'];

$user = $_SESSION['user_name'];

$query = "SELECT user_id, user_password FROM users WHERE user_name = ?";
$stmt = $conection->prepare($query);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

$stored_password = $userData['user_password'];
$user_id = $userData['user_id'];

if($password_delete == $password_delete_rpt){
    if($password_delete == $stored_password){
        $deleteQuery = "DELETE FROM users WHERE user_id = ? AND user_name = ?";
        $deleteStmt = $conection->prepare($deleteQuery);
        $deleteStmt->bind_param("is", $user_id, $user);
        $deleteStmt->execute();
        
        echo "<script>
        alert('Account deleted successfully!')
        location.href = 'sign_out.php';
        </script>";
    } else {
        echo "<script>
        alert('Incorrect password!')
        location.href = '../NAV/user.php';
        </script>";
    }
}else{
    echo "<script>
    alert('Passwords do not match!')
    location.href = '../NAV/user.php';
    </script>";
}

$stmt->close();
$deleteStmt->close();
$conection->close();
?>