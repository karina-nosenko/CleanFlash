<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
        crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js"></script>
    <link rel="icon" href="favicon.ico">

    <title>CleanFlash</title>
</head>

<body>
    <!-- HEADER -->
    <header>
        <a id="logo" href="index.html"></a>

        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button type="button" id="search">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>

        <a id="profile" href="#"></a>
    </header>

    <!-- MAIN NAVIGATION -->
    <nav id="mainNav">
        <a href="#" >
            <span class="material-icons">timelapse</span>
            <p>Open events</p>
        </a>
        <a href="index.html"class="selected">
            <span class="material-icons">home</span>
            <p>Home</p>
        </a>
        <a href="List.html">
            <span class="material-icons">assignment_turned_in</span>
            <p>Closed Events</p>
        </a>
    </nav>

    <div id="wrapper">

        <!-- SIDE NAVIGATION + HAMBURGER -->
        <nav id="sideNav">

            <div class="mhead">
                <div class="menu-ham">
                    <span class="material-icons">menu</span>
                </div>
            </div>

            <div class="menu">
                <div class="close-menu">
                    <span class="material-icons">menu_open</span>
                </div>

                <ul>
                    <li>
                        <a href="index.html" class="selected">
                            <span class="material-icons">home</span>
                            <span class="link">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="material-icons">timelapse</span>
                            <span class="link">Open Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="List.html">
                            <span class="material-icons">assignment_turned_in</span>
                            <span class="link">Closed Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="material-icons">settings</span>
                            <span class="link">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>

        </nav>

        <!-- BREADCRUMBS -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Spot Cleaning</li>
            </ol>
        </nav>

        <!-- MAIN -->
        <main>
            <header>
            </header>

            <section id="content">
                <h5> 
                    <?php
                        <b>echo "The details accepted successffully"</b>
                    ?>
                </h5>
            </section>

        </main>
    </div>
    <!-- FOOTER -->
    <footer>
        <p>Made by Yosef & Karina &copy; 2021</p>
    </footer>
</body>

</html>