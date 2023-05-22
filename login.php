<?php

session_start();

$infoMessage = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $aConfig = require_once 'config.php';
    $db = mysqli_connect(
        $aConfig['host'],
        $aConfig['user'],
        $aConfig['pass'],
        $aConfig['name']
    );
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $dbResponse = mysqli_query($db, $query);
    $aUsers = mysqli_fetch_all($dbResponse, MYSQLI_ASSOC);

    if (count($aUsers) > 0) {
        $_SESSION['auth'] = true;
        header('Location: /admin.php');
        exit();
    }
    mysqli_close($db);

    $infoMessage = 'Invalid login or password. Maybe you need create an account?';
}

?>


<!DOCTYPE html>
<html lang="">

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">

    <?php require_once 'sectionNavbar.php' ?>

    <br>

    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            Login form
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Email
                        <input class="form-control" type="email" name="email">
                    </label>
                </div>

                <div class="form-group">
                    <label>Password
                        <input class="form-control" type="password" name="password">
                    </label>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="form">
                </div>
            </form>

            <?php
            if ($infoMessage) {
                echo '<hr/>';
                echo "<span style='color:red'>$infoMessage</span>";
            }
            ?>

        </div>
    </div>
</div>


</body>
</html>
