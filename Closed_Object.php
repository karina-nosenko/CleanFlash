<?php
    include "db.php";
    include "config.php"; 
    session_start();

    if(!isset($_SESSION["user_email"])){
        header('Location: ' . URL . 'index.php');
    }
?>

<?php
    // get data from DB
    $objId = $_GET["objId"];
    $query = "SELECT * FROM tbl_events_216 where event_id=" . $objId;
    $result = mysqli_query($connection, $query);

    if($result) {
        $row = mysqli_fetch_assoc($result);
    }
    else die("DB query failed.");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"> 

        <!-- Bootstrap for modal box -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- JQuery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/scripts.js"></script>
        <script src="data/db.json"></script>
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
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>      
                    </button>

                    <a id="profile" href="profile_page.php" title="Profile">
                    <?php
                        echo '<img src="'.$_SESSION["user_image"].'">';
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
                    <a href="#" class="selected"> 
                        <span class="material-icons" id="closed_icon">assignment_turned_in</span>
                        <p>Closed Events</p>
                    </a>
                </nav>

                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="Closed_List.php">Closed Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php
                            echo $row["address"];
                        ?>
                    </li>
                    </ol>
                </nav>
             
            </div>

            <!-- Heading -->
            <section class="header" id="mob_h">
                <?php
                    echo '<h1>' . $row["address"] . '</h1>';
                ?>
                <span class="material-icons deletion_icon" title="Delete this event" data-toggle="modal" data-target="#note_msg">delete</span>
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
                    <li id="selected">
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
                        echo '<h1>' . $row["address"] . '</h1>';
                    ?>
                    <span class="material-icons" title="Delete this event" data-toggle="modal" data-target="#note_msg" class="deletion_icon">delete</span>
                </section>

                <!-- Confirmation before deletion -->
                <div class="modal fade" id="note_msg" role="dialog">
                    <div class="modal-dialog">  
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Confirm Deletion</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete that event?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><b>No, cansel</b></button>
                                <form action="Closed_List.php" method="GET">
                                    <input type="hidden" name="delete" value="<?php echo $objId;?>">
                                    <input type="submit" value="Yes, continue" class="btn btn-default">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sub_container1">
                    <?php
                        $img_1 = $row["image_before"];
                        $img_2 = $row["image_after"];
                        if(!$img_1) $img = "images/image_1.png";
                        if(!$img_2) $img = "images/image_2.png";

                        echo '<p><b>Event type: </b><span class="TypeOfEvent">' . $row["event_type"] . '</span></p>';
                        echo '<p><b>Date: </b>' . $row["date"] . '</p>';
                        echo '<p><b>Start time: </b>' . $row["start_time"] . '</p>';
                        echo '<p><b>Finish time: </b>' . $row["finish_time"] . '</p>';
                        echo '<p><b>Treatment time: </b><span class="ArrivedOnTime">' . $row["arrival_status"] . '</span></p>';
                    ?>

                    <button type="button" title="Reopen the current event" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg"
                            width="13" height="13" fill="currentColor" class="bi bi-bootstrap-reboot"
                            viewBox="0 0 16 16">
                            <path
                                d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 1 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.812 6.812 0 0 0 1.16 8z" />
                            <path
                                d="M6.641 11.671V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352h1.141zm0-3.75V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324h-1.6z" />
                        </svg> Recover Event</button>
                </div>
                <div class="sub_container2">
                    <p>Before <span class="After_span">After</span></p>
                    <?php
                        echo '<img src="' . $img_1 . '" class="Image_before" alt="before" title="before">';
                        echo '<img src="' . $img_2 . '" class="Image_after" alt="after" title="after">';
                    ?>
                </div>

                <?php
                    //release returned data
                    mysqli_free_result($result);
                ?>

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