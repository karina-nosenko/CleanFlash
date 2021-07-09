<?php
include "db.php";
include "config.php";
session_start();
if (!empty($_POST["loginNewpass"])) {
    $newpassWord = $_POST["loginNewpass"];
    $emailAddress = $_SESSION["user_email"];
    $query  = "UPDATE tbl_users_216
    SET password = '$newpassWord'
    WHERE email ='$emailAddress'";
    if(mysqli_query($connection, $query))
        header('Location: ' . URL . 'profile_page.php');
    else
        header('Location: ' . URL . 'Home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js"></script>
    <link rel="icon" href="favicon.ico">

    <title>CleanFlash</title>
</head>

<body>
    <div id="page-container">
        <div id="global">
            <!-- Header -->
            <header>
                <a id="logo" href="Home.php"></a>
            </header>

            <!-- Main Navigation -->
            <nav id="mainNav">
            </nav>

            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
            </nav>

        </div>

        <!-- Heading -->
        <section class="header">
        </section>

        <!-- Side Navigation + Hamburger -->
        <span onclick="openNav()" id="hamburger"><span class="material-icons">menu</span></span>



        <!-- Main content -->
        <div id="main">
            <div class="whiteSpace"></div>

            <div class="sub_container1">

            </div>
            <div class="sub_container2">
            </div>
            <div class="container">
                <h1>Change password</h1>
                <script>
                    function confirm_() {
                        return false;
                    }
                </script>
                <form action="#" method="post" id="frm">
                    <div class="form-group">
                        <label class="formlabel">New password:</label>
                        <input type="password" id="loginfield" class="form-control" name="loginNewpass" id="loginNewpass" placeholder="Enter Password" required/>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <div class="error-massage"><?php if (isset($message)) {
                                                    echo $message;
                                                } ?></div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>Made by Yosef & Karina &copy; 2021</p>
        </footer>

    </div>
</body>

</html>

<?php
//close DB connection
mysqli_close($connection);
?>