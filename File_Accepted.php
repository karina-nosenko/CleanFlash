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
                    <a id="logo" href="index.html"></a>
                    
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button type="button" id="search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>      
                    </button>

                    <a id="profile" href="#"></a>
                </header>

                <!-- Main Navigation -->
                <nav id="mainNav">
                    <a href="#">
                        <span class="material-icons">timelapse</span>
                        <p>Open events</p>
                    </a>
                    <a href="index.html" class="selected">
                        <span class="material-icons">home</span>
                        <p>Home</p>
                    </a>
                    <a href="List.html"> 
                        <span class="material-icons">assignment_turned_in</span>
                        <p>Closed Events</p>
                    </a>
                </nav>

                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Spot Cleaning</li>
                    </ol>
                </nav>
             
            </div>

            <!-- Heading -->
            <section class="header">
            </section>

            <!-- Side Navigation + Hamburger -->
            <span onclick="openNav()" id="hamburger"><span class="material-icons">menu</span></span>

            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="material-icons">menu_open</span></a>
                <a href="#"><span class="material-icons">home</span>Home</a>
                <a href="#"><span class="material-icons">timelapse</span>Open Events</a>
                <a href="#"><span class="material-icons">assignment_turned_in</span>Closed Events</a>
                <a href="#"><span class="material-icons">settings</span>Settings</a>
            </div>

            <!-- Main content -->
            <div id="main">
                <div class="whiteSpace"></div>

                <h5> 
                    <?php
                        echo "<b>The details accepted successffully</b>"
                    ?>
                </h5>

            </div>

            <!-- Footer -->
            <footer>
                <p>Made by Yosef & Karina &copy; 2021</p>
            </footer>

        </div>
    </body>
</html>