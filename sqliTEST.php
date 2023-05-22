<?php
$host = 'localhost'; // ім'я хоста
$user = 'root'; // Ім'я користувача
$pass = ''; // пароль
$name = 'guestbool' ; // ім'я бази даних
$db = mysqli_connect ( $host, $user, $pass, $name ) ;
$query = 'SELECT * FROM Users' ;
$dbResponse = mysqli_query ($db, $query);
$aUsers = mysqli_fetch_all($dbResponse, MYSQLI_ASSOC);
mysqli_close ($db);
var_dump($aUsers) ;
?>
