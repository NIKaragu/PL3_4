<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();
// TODO 2: ROUTING

// TODO 3: CODE by REQUEST METHODS (ACTIONS) GET, POST, etc. (handle data from request): 1) validate 2) working with data source 3) transforming data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// check for data presence
    if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['text'])) {
// perform validation if needed
// prepare data for saving
        $data = [
            $_POST['email'],
            $_POST['name'],
            $_POST['text'],
            date('Y-m-d H:i:s')
        ];
// open file for appending and save data
        $file = fopen('comments.csv', 'a');
        fputcsv($file, $data);
        fclose($file);
    }
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

                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter em-
ail">

                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter

name">

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
                    $file = fopen('comments.csv', 'r');
                    if ($file) {
                        while (($data = fgetcsv($file)) !== false) {
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<p><strong>' . $data[1] . '</strong> <small class="text-muted">' . $data[0] . '</small></p>';
                            echo '<p>' . $data[2] . '</p>';
                            echo '<small class="text-muted">' . $data[3] . '</small>';
                            echo '</div>';
                            echo '</div>';
                        }
                        fclose($file); }
                    ?>
                </div>
            </div>
        </div>
</html>