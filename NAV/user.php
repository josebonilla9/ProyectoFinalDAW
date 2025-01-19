<?php include("../PHP/conection.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
</head>
<body>
    <div class="top-container">
        <?php include("../PHP/validation.php") ?>
    </div>

    <div>
        <h1 class="welcome display-4 text-center my-5">Welcome <?php echo $_SESSION['user_name'] ?></h1>
    </div>

    <div class="profile">
        <h1 class="display-4 text-center my-5">User information</h1>
        <div>
            <table class="table table-hover mx-auto text-center w-25" id="user-table">
                <?php
                    $user = $_SESSION['user_name'];
                    $data = mysqli_query($conection, "SELECT * FROM users WHERE user_name = '$user'");

                    while($row = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <th>User: </th>
                    <td><?php echo $row['user_name'] ?></td>
                </tr>
                <tr>
                    <th>Email: </th>
                    <td><?php echo $row['user_email'] ?></td>
                </tr>
                <tr>
                    <th>Phone: </th>
                    <td><?php echo $row['user_phone'] ?></td>
                </tr>

                <?php } ?>
            </table>
        </div>

        <div class="cont-boton text-center">
            <input type="button" class="btn btn-success user_table_button" value="Edit profile" name="edit" style="background-color: #1e293b; color: white; border: none;" data-bs-toggle="modal" data-bs-target="#edit-modal">
            <input type="button" class="btn btn-danger user_table_button" value="Delete account" name="delete" style="border: none;" data-bs-toggle="modal" data-bs-target="#delete-modal">
        </div>                

    </div>

    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="edit-form">
                    <?php
                        $user = $_SESSION['user_name'];
                        $data = mysqli_query($conection, "SELECT * FROM users WHERE user_name = '$user'");

                        while($row = mysqli_fetch_array($data)){
                    ?>

                    <div>
                        <label for="recipient-name" class="col-form-label">User:</label>
                        <input type="text" class="form-control" name="user_name_form" value="<?php echo $row['user_name'] ?>" disabled>
                    </div>
                    <div>
                        <label for="recipient-name" class="col-form-label">Email address:</label>
                        <input type="text" class="form-control" name="user_email_form" value="<?php echo $row['user_email'] ?>">
                    </div>
                    <div>
                        <label for="recipient-name" class="col-form-label">Phone number:</label>
                        <input type="text" class="form-control" name="user_phone_form" value="<?php echo $row['user_phone'] ?>">
                    </div>
                    <div>
                        <label for="recipient-name" class="col-form-label">Current password:</label>
                        <input type="password" name="user_password_form" class="form-control" id="current-password">
                    </div>
                    <div>
                        <label for="recipient-name" class="col-form-label">New password:</label>
                        <input type="password" name="user_new_password_form" class="form-control" id="new-password" disabled>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="edit-password">
                        <label class="form-check-label" for="flexCheckDefault">
                            Change password
                        </label>
                    </div>

                    <?php } ?>
                </form>
            </div>

            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_button" style="background-color: #1e293b; color: white; border: none;">Update</button>
            </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../PHP/delete_user.php" method="POST">
                    <div>
                        <label for="recipient-name" class="col-form-label">Password:</label>
                        <input type="password" name="user_password_delete" class="form-control">
                    </div>
                    <div>
                        <label for="recipient-name" class="col-form-label">Repeat password:</label>
                        <input type="password" name="user_password_delete_rpt" class="form-control">
                    </div>

                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="delete-account-check">
                            <label class="form-check-label" for="delete-account">
                                Delete account
                            </label>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" id="delete-button" disabled>Delete</button>
                        </div>
                    </div>
                </form>
            </div>            

            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong><strong>Warning! </strong></strong> Deleting your account will permanently erase all information associated with it from the database.
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../JS/functions.js"></script>
</body>
</html>