<?php
include ('conection.php');
session_start();

$password = "";

$password_delete = $_POST['user_password_delete'];
$password_delete_rpt = $_POST['user_password_delete_rpt'];

$user = $_SESSION['user_name'];

$data = mysqli_query($conection, "SELECT * FROM users WHERE user_name = '$user'");

while($row = mysqli_fetch_array($data)){
    $password = $row['user_password'];
    $user_name = $row['user_name'];
    $user_id = $row['user_id'];
}

if($password_delete == $password_delete_rpt){
    if($password_delete == $password){
        $delete = "DELETE FROM users WHERE user_id = '$user_id' AND user_name = '$user_name'";
        $result = mysqli_query($conection, $delete);
        
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

mysqli_close($conection);
?>