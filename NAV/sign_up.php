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

    <form action="../PHP/records.php" method="POST" class="signup_form" id="sign_up_form">
        <h2 class="info_form">Sign up</h2>
        <input type="text" require placeholder="User Name" class="formula" name="user_name">
        <input type="text" require placeholder="E-Mail" class="formula" name="user_email">
        <input type="text" require placeholder="Phone Number" class="formula" name="user_phone">
        <input type="password" require placeholder="Password" class="formula" name="user_password">
        <div>
            <input type="submit" class="formula_enviar">
        </div>
    </form>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="../JS/functions.js"></script>

</body>
</html>