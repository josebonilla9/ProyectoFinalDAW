<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="nav">
        <div class="navbar-brand logo">
            <i class='bx bx-candles'></i>
            <a href="home.php" class="text-decoration-none">DailyTrading</a>
        </div>

        <div class="right-section">

            <div class="profile" style="color: white; text-align: center; padding: 0px 20px;">

                <div id="navbarNavDropdown" class="collapse show">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['user_name'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="user.php">My profile</a></li>
                                <li><a class="dropdown-item" href="../PHP/sign_out.php">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        
    </div>

    <script type="text/javascript" src="../JS/bootstrap.bundle.min.js"></script>
</body>
</html>