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
        <?php include("../PHP/validation.php") ?>
    </div>

    <style>
        .submit_button {
            background-color: #212121;
            color: #fff;
            padding: 10px 48px;
            margin: 8px 0;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
    </style>

    <form action="../PHP/records.php" method="POST" class="signup_form mx-auto text-center w-25" id="sign_up_form">
        <h2 class="info_form">Sign up</h2>
        <input type="text" require placeholder="User Name" class="form-control" name="user_name">
        <input type="text" require placeholder="E-Mail" class="form-control" name="user_email">
        <input type="text" require placeholder="Phone Number" class="form-control" name="user_phone">
        <input type="password" require placeholder="Password" class="form-control" name="user_password">
        <div>
            <input type="submit" class="formula_enviar submit_button" style="margin-top: 15px;">
        </div>
    </form>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="../JS/functions.js"></script>

</body>
</html>