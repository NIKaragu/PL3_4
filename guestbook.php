<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();
// TODO 2: ROUTING
// TODO 3: CODE by REQUEST METHODS (ACTIONS) GET, POST, etc. (handle data from request): 1) validate 2) working with data source 3) transforming data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aComment = array(
        'email' => $_POST['email'],
        'login' => $_POST['name'],
        'text' => $_POST['text'],
        'date' => date('Y-m-d H:i:s')
    );

// TODO in PHP part
    $aConfig = require_once 'config.php';
    $db = mysqli_connect(
        $aConfig['host'],
        $aConfig['user'],
        $aConfig['pass'],
        $aConfig['name']
    );
    $query = "INSERT INTO comments (email, login, text, create_date) VALUES (
        '".$aComment['email']."',
        '".$aComment['login']."',
        '".$aComment['text']."',
        '".$aComment['date']."'
)";
    mysqli_query($db, $query);
    mysqli_close($db);

// Перенаправление на страницу после успешной вставки данных
    header('Location: guestbook.php');
    exit();
}
// TODO 4: RENDER: 1) view (html) 2) data (from php)
?>
<!DOCTYPE html>
<html>
<?php require_once 'sectionHead.php' ?>
<body>
<div class="container">
    <!-- navbar menu -->
    <?php require_once 'sectionNavbar.php' ?>
    <br>
    <!-- guestbook section -->
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            GuestBook form
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <!-- TODO: create guestBook html form -->
                    <form method="POST">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="text">Text</label>
                            <textarea class="form-control" id="text" name="text" placeholder="Enter text"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <br>
    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            Comments
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <!-- TODO: render guestBook comments -->
                    <?php
                    // TODO in HTML part
                    $aConfig = require_once 'config.php';
                    $db = mysqli_connect(
                        $aConfig['host'],
                        $aConfig['user'],
                        $aConfig['pass'],
                        $aConfig['name']
                    );
                    $query = 'SELECT * FROM Comments';
                    $dbResponse = mysqli_query($db, $query);
                    $aComments = mysqli_fetch_all($dbResponse, MYSQLI_ASSOC);
                    mysqli_close($db);
                    foreach($aComments as $comment) {
                        echo $comment['login'].'<br>';
                        echo $comment['email'].'<br>';
                        echo $comment['text'].'<br>';
                        echo $comment['create_date'].'<br>';
                        echo '<hr>';
                    }
                    ?>
                </div>
            </div>
        </div>
</html>