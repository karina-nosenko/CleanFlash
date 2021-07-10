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
    //get data from DB
    $isedit = isset($_GET["objId"]);
    if($isedit) $state="edit";
    else        $state="insert";

    if($isedit){
        $objId = $_GET["objId"];
        $query = "SELECT * FROM tbl_events_216 where event_id='" . $objId . "'" ;
        $result = mysqli_query($connection, $query);
    }

    if($result) {
        $row = mysqli_fetch_assoc($result); // there is only 1 item with id=X
    }
    else{
        $objId=0;
    }

    if($isedit) {
        $addr = $row['address'];
        $waste_type = $row["waste_type"];
        $image_before = $row["image_before"];
        if($image_before == "") {
            $image_before = "No image selected";
        }
    }
    else {
        $addr = "";
        $waste_type = "";
        $image_before = "No image selected";
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

        <!-- Drag and drop files -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
                    <li class="breadcrumb-item active" aria-current="page">Spot Cleaning</li>
                    </ol>
                </nav>
             
            </div>

            <!-- Heading -->
            <section class="header" id="mob_h">
                <h1>Spot Cleaning</h1>
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
                    <h1>Spot Cleaning</h1>
                </section>

                <form action="File_Accepted.php" name="myForm" method="GET" onsubmit="return check()">

                    <div class="form-group">
                        <label class="asterisk">*</label>
                        <label><b>Enter the location</b></label><br>
                        <input type="text" class="filefield form-control" id="inputAddress" placeholder="Streetname 1, Haifa" name="location" value="<?php echo $addr;?>">
                    </div>

                    <label class="asterisk">*</label>
                    <label><b>Please select the type of waste</b></label><br>
                    <select class="filefield custom-select my-1 mr-sm-2" id="cat" name="waste_type" data-selected="<?php echo $waste_type;?>">
                        <option value="">Select</option>
                        <option value="1">Metal</option>
                        <option value="2">Wood</option>
                        <option value="3">Plastic</option>
                        <option value="4">Organic</option>
                        <option value="5">Glass</option>
                        <option value="6">Other</option>
                    </select>
                    
                    <div class="mob_form">
                        <label class="asterisk">*</label>
                        <label><b>Upload a picture of the waste</b></label><br>
                        <input type="text" name="img" class="filefield custom-select my-1 mr-sm-2" id="img" value="<?php echo $image_before;?>"><br>
                    </div>

                    <div class="desc_form">
                        <label class="asterisk">*</label>
                        <label><b>Upload a picture of the waste</b></label><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group files">
                                    <input type="text" name="img" class="filefield" id="img_upload" value="<?php echo $image_before;?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="event_type" value="1">
                    <input type="hidden" name="event_status" value="0">
                    <input type="hidden" name="state" value="<?php echo $state;?>">
                    <input type="hidden" name="objId" value="<?php echo $objId;?>">

                    <input type="submit" id="submit" class="btn btn-primary btn-lg">
                </form>

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