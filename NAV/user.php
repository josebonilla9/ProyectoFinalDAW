<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
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

        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="#">Statistics</a>
            <a href="#">Blog</a>
            <a href="#">Live</a>
        </div>

        <div class="right-section">
            <i class='bx bx-bell'></i>

            <div class="profile">
                <div class="info">
                    <!-- <img src="../assets/profile.png"> -->
                    <div class="user-button">
                        <ul class="nav nav-pills">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo $_SESSION['user_name'] ?></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                            <!-- <p>Premium</p> -->
                    </div>
                </div>
                <i class='bx bx-chevron-down'></i>
            </div>
        </div>
    </div>
</div>

    <div>
        <h1 class="welcome">Welcome <?php echo $_SESSION['user_name'] ?></h1>
    </div>

</body>
</html>