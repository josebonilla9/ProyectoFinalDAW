<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="top-container">

        <div class="nav">
            <div class="logo">
                <i class='bx bx-candles'></i>
                <a href="#">DailyTrading</a>
            </div>
        </div>

    </div>

    <form action="../PHP/login.php" method="POST" class="sign_in_form">
        <h2 class="info_form">Sign in</h2>
        <input type="text" require placeholder="User Name" class="formula" name="user_name">
        <input type="password" require placeholder="Password" class="formula" name="user_password">
        <div>
            <input type="submit" class="formula_enviar">
        </div>
    </form>
    
</body>
</html>