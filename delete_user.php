<?php
include "db.php";
include "config.php";
session_start();
$emailAddress = $_SESSION["user_email"];
$passWord = $_POST["loginPass"];
$query  = "DELETE FROM tbl_users_216 WHERE email= '$emailAddress'";
mysqli_query($connection, $query);
session_destroy();
header('Location: ' . URL . 'index.php');
?>

<?php
//close DB connection
mysqli_close($connection);
?>