<?php
    include "db.php";
    include "config.php";
    session_start();

    if(!isset($_SESSION["user_email"])){
        header('Location: ' . URL . 'index.php');
    }
?>

<?php 
    error_reporting(0);
	//get data from querystring and escape variables for security
	$location 	    = mysqli_real_escape_string($connection, $_GET['location']);
	$event_type  	= mysqli_real_escape_string($connection, $_GET['event_type']);
	$waste_type    	= mysqli_real_escape_string($connection, $_GET['waste_type']);
    $image_before   = mysqli_real_escape_string($connection, $_GET['img']);
    $event_status   = mysqli_real_escape_string($connection, $_GET['event_status']);
	$state    	    = $_GET['state'];
	$objId    	    = $_GET['objId'];
    $email          = $_SESSION["user_email"];

    $case = 0;
    $sharedId = 0;

    // The new location is shared, if it already exists and it doesn't belong to me
    $isSharedQuery = "SELECT * FROM tbl_users_events_216 ue INNER JOIN tbl_events_216 e
                            USING(event_id)
                             WHERE e.address = '$location' and ue.email != '$email' and e.event_status=0";
    $isShared = mysqli_query($connection, $isSharedQuery);
    if(!$isShared){
        die("DB query1 failed.");
    }
    $shared =  mysqli_fetch_assoc($isShared);
    
    if($shared["address"]) {
        $case = 'view only';
        $sharedId = $shared["event_id"];
    }
    else {
        if($state == "insert")  $case = 'just insert';
        else                    $case = 'just update';
    }

    // Check the situation when the location already exists, and it opened by me
    $isOpenedQuery = "SELECT * FROM tbl_users_events_216 ue INNER JOIN tbl_events_216 e
                            USING(event_id)
                             WHERE e.address = '$location' and ue.email = '$email' and e.event_status=0";
    $isOpened = mysqli_query($connection, $isOpenedQuery);
    if(!$isOpened){
        die("DB query2 failed.");
    }
    $opened =  mysqli_fetch_assoc($isOpened);

    if($opened["address"]) {
        if($state == "insert") {
            $case = 'already opened by me';
        }
        else {
            //if the updated location is the same to the previous one - it's a regular update
            $isSameQuery = "SELECT * FROM tbl_events_216 WHERE address = '$location' and event_id = $objId";
            $isSame = mysqli_query($connection, $isSameQuery);
            if(!$isSame){
                die("DB query3 failed.");
            }
            $same =  mysqli_fetch_assoc($isSame);
            $case = $same["address"] ? 'just update' : 'already opened by me';
        }
    }

    // Implement the relevant case
    switch($case) {
        case 'just update':
            $query = "UPDATE tbl_events_216 
                        SET address='$location',event_type='$event_type',waste_type='$waste_type',image_before='$image_before',
                        event_status='$event_status', start_time=current_timestamp, date=current_date WHERE event_id='$objId'";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("DB query4 failed.");
            }
            break;

        case 'just insert':
            // insert to the tbl_events_216 table
            $query =    "INSERT INTO tbl_events_216(address,event_type,waste_type,image_before,event_status, start_time, date) 
                            VALUES ('$location','$event_type','$waste_type','$image_before','$event_status', current_timestamp , current_date); ";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("DB query5 failed.");
            }
            // insert to the tbl_users_events_216 table
            $lastId = $connection->insert_id;
            $query =    "INSERT INTO tbl_users_events_216(email, event_id, permission) 
                                VALUES ('$email', $lastId, 1)";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("DB query6 failed.");
            }      
            //update the estimated arrival time
            $query = "UPDATE tbl_events_216 SET arrival_time=addtime(start_time,900) WHERE event_id=$lastId";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die("DB query7 failed.");
            }
            break;

        case 'view only':
            // insert to the tbl_users_events_216 table with view only permission
            $query = "INSERT INTO tbl_users_events_216(email, event_id, permission)
                        VALUES ('$email', $sharedId , 0)";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die("DB query8 failed.");
            }
            //delete the previous event from the current user in case of update
            if ($state == "edit") {
                $query = "DELETE FROM tbl_events_216 WHERE event_id='$objId'";
                $result = mysqli_query($connection, $query);
                if(!$result) {
                    die("DB query9 failed.");
                }
            } 
            echo '<script> if(!alert("Event with the same address is already opened by another user You can view its progress but cannot edit"))
                    { window.location.href="./Opened_List.php"; }; </script>';       
            break;

        case 'already opened by me':
            echo '<script> if(!alert("You already opened an event to that address"))
                    { window.location.href="./Opened_List.php"; }; </script>';
            break;

        default:
            //do nothing
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
                    <a href="Home.php" class="selected">
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
                    <li class="breadcrumb-item active" aria-current="page">Spot Cleaning</li>
                    </ol>
                </nav>
             
            </div>

            <!-- Heading -->
            <section class="header" id="mob_h">
            </section>

            <!-- Side Navigation + Hamburger -->
            <span onclick="openNav()" id="hamburger"><span class="material-icons">menu</span></span>

            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="material-icons">menu_open</span></a>

                <ul id="accordion" class="accordion">
                    <li id="selected">
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
                </section>

                <h5> 
                    <?php
                        echo "<b>The details accepted successfully</b><br>"
                    ?>
                    <a href="Opened_List.php" class="btn btn-primary btn-lg" id="return">Go to Opened Events List</a>
                </h5>

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