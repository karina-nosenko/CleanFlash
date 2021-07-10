<?php
include "db.php";
include "config.php";
session_start();

if (!isset($_SESSION["user_email"])) {
    header('Location: ' . URL . 'index.php');
}
?>

<?php
error_reporting(0);
$delete = $_GET["delete"];
if ($delete) {
    $query = "DELETE FROM tbl_events_216 WHERE event_id='$delete'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("DB query failed.");
    }
}

// get all data from DB
$query = "SELECT * FROM tbl_events_216 WHERE event_status=0 order by start_time and date";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("DB query failed.");
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

                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button type="button" id="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>

                <a id="profile" href="profile_page.php" title="Profile">
                    <?php
                    echo '<img src="' . $_SESSION["user_image"] . '">';
                    ?>
                </a>
            </header>

            <!-- Main Navigation -->
            <nav id="mainNav">
                <a href="Opened_List.php">
                    <span class="material-icons">timelapse</span>
                    <p>Open events</p>
                </a>
                <a href="Home.php">
                    <span class="material-icons" id="home_icon">home</span>
                    <p>Home</p>
                </a>
                <a href="Closed_List.php">
                    <span class="material-icons" id="closed_icon">assignment_turned_in</span>
                    <p>Closed Events</p>
                </a>
            </nav>

            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>

        </div>

        <!-- Heading -->
        <section class="header" id="mob_h">
            <?php
            echo '<h1>Hello ' . $_SESSION["user_name"] . '</h1>';
            ?>
        </section>

        <!-- Side Navigation + Hamburger -->
        <span onclick="openNav()" id="hamburger"><span class="material-icons">menu</span></span>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="material-icons">menu_open</span></a>

            <ul id="accordion" class="accordion">
                <li>
                    <a href="Home.php" class="link"><i class="fa"><span class="material-icons">home</span></i>Home</a>
                </li>
                <li>
                    <a href="Opened_List.php" class="link"><i class="fa"><span class="material-icons">timelapse</span></i>Open Events</a>
                </li>
                <li>
                    <a href="Closed_List.php" class="link" id="hasSubmenu"><span class="down"><i class="fa"><span class="material-icons">assignment_turned_in</span></i>Closed Events</span><i class="fa fa-chevron-down"></i></a>
                    <ul class="submenu">
                        <li><a href="#"><span class="material-icons">cached</span>Recovered</a></li>
                        <li><a href="#"><span class="material-icons">delete</span>Deleted</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="link"><i class="fa"><span class="material-icons">settings</span></i>Settings</a>
                </li>
            </ul>
        </div>

        <!-- Main content -->
        <div id="main">
            <div class="whiteSpace"></div>

            <!-- Heading -->
            <section class="header" id="desk_h">
                <?php
                echo '<h1>Hello ' . $_SESSION["user_name"] . '</h1>';
                ?>
            </section>
            <div class="person-details">
                <?php
                echo '<div id="profile_template">';
                echo '<div id="profile_name"><span><b>Your Name: </b>' . $_SESSION["user_name"] . '</span></div>';
                echo '<div id="profile_email"><b>Your Email: </b>' . $_SESSION["user_email"] . '</div>';
                echo '</div>';
                ?>
            </div>
            <a href="update_user.php"> <button type="button" data-toggle="modal" data-target="#note_msg" class="btn btn-primary" id="changepassword">Update password</button></a>
            <a href="logout.php"><button type="button" class="btn btn-warning" id="logout">Logout</button></a>
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger" class="btn btn-danger" id="delaccount">Delete account</button>

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Validation -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirm Deletion</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the account?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><b>No, cansel</b></button>
                            <form action="delete_user.php" method="POST">
                                <input type="hidden" name="delete" value="<?php echo $objId; ?>">
                                <input type="submit" value="Yes, continue" class="btn btn-default">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php
        mysqli_free_result($result);
        ?>

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