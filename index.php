<<<<<<< HEAD
<?php 
    session_start();

    $con = mysqli_connect('localhost', 'root', '');
    $query_run = mysqli_query($con, 'SHOW DATABASES LIKE "venue"');
    if(mysqli_num_rows($query_run) == null)
    {
        $sql = "CREATE DATABASE venue";
        if ($con->query($sql) !== TRUE)
        {
            echo "Error creating database: " . $con->error;
        }
    }
    //------------------------------------------ LOCATIONS -------------------------------------------
    $con = mysqli_connect('localhost', 'root', '', 'venue');
    $result = mysqli_query($con, 'SHOW TABLES LIKE "locations"');
    if(mysqli_num_rows($result) == null)
    {
        $sql = "CREATE TABLE locations (".
        "location_id INT(6) AUTO_INCREMENT PRIMARY KEY,".
        "location VARCHAR(255) NOT NULL,".
        "rating FLOAT,".
        "rating_count INT(6)".
        ")";
        if($con->query($sql) !== TRUE) echo $con->error;
    }
    //-------------------------------------------- PHOTOS ---------------------------------------------
    $result = mysqli_query($con, 'SHOW TABLES LIKE "photos"');
    if(mysqli_num_rows($result) == null)
    {
        $sql = "CREATE TABLE photos (".
        "photo_id INT(6) AUTO_INCREMENT PRIMARY KEY,".
        "photo_dir VARCHAR(250) NOT NULL,".
        "location_id INT(6) NOT NULL".
        ")";
        if($con->query($sql) !== TRUE) echo $con->error;
    }
    //-------------------------------------------- USERS ---------------------------------------------
    $result = mysqli_query($con, 'SHOW TABLES LIKE "users"');
    if(mysqli_num_rows($result) == null)
    {
        $sql = "CREATE TABLE users (".
        "user_id INT(6) AUTO_INCREMENT PRIMARY KEY,".
        "full_name VARCHAR(50) NOT NULL,".
        "email VARCHAR(50) NOT NULL,".
        "password VARCHAR(20) NOT NULL,".
        "user_photo VARCHAR(50) NOT NULL".
        ")";
        if($con->query($sql) !== TRUE) echo $con->error;
    }
    error_reporting(0);
    if(!file_exists('upload')) mkdir('uploads');
    if(!file_exists('upload/add')) mkdir('uploads/add');
    if(!file_exists('upload/pfp')) mkdir('uploads/pfp');
?>
=======
<?php session_start(); //print_r($_COOKIE); ?>
>>>>>>> master
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Venue - Travel</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="templatemo-style.css?v=<?php echo time(); ?>">
<<<<<<< HEAD
=======
        <link rel="icon" type="image/x-icon" href="favicon.ico">
>>>>>>> master
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    </head>

    <body>
    
        <div class="wrap" id="wrap">
            <header id="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="primary-nav-button" type="button">Menu</button>

                            <a href="index.php">
                                <div style="float: left;">
<<<<<<< HEAD
                                    <img src="https://drive.google.com/uc?export=view&id=1dNONzGxU2kLCbZaGifdFIpKEenn7vsKh" alt="Venue Logo">
=======
                                    <img src="https://live.staticflickr.com/65535/53920110072_e335c9b144_m.jpg" alt="Venue Logo">
>>>>>>> master
                                </div>
                            </a>
                            
                            <nav id="primary-nav" class="dropdown cf">
<<<<<<< HEAD
                                <ul class="dropdown menu">
                                    <li id="login">
                                        <a style="cursor: pointer;">
                                        <?php
                                            if(isset($_SESSION['user_id'])) echo 'Log out';
                                            else echo 'Login';
                                        ?>
                                        </a>
                                    </li>
                                    <li><a href="add.php">Add</a></li>
                                    <li><a href="popular.php">Most Rated</a></li>
                                        <?php
                                            if(isset($_SESSION['user_id']))
                                            echo '<li><div id="pfp_div" style="margin-top: 27px"><img id="pfp" src="'. $_SESSION['pfp'] .'" alt="" srcset=""></div></li>';
                                        ?>
                                </ul>
=======
                            <ul class="dropdown menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="add.php">Contribute</a></li>
                                <li><a href="popular.php">Most Rated</a></li>
                                <li id="login">
                                    <a style="cursor: pointer;">
                                    <?php
                                        if(isset($_SESSION['user_id'])) echo 'Log out';
                                        else echo 'Login';
                                    ?>
                                    </a>
                                </li>
                                <?php
                                    if(!isset($_SESSION['user_id'])) echo '
                                    <li id="register">
                                        <a style="cursor: pointer">
                                            Register
                                        </a>
                                    </li>';

                                    if(isset($_SESSION['user_id']))
                                    echo '<li><div id="pfp_div" style="margin-top: 27px"><img id="pfp" src="'. $_SESSION['pfp'] .'" alt="" srcset=""></div></li>';
                                ?>
                            </ul>
>>>>>>> master
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <section class="banner" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="submit-form" style="margin-top: 12vh">
<<<<<<< HEAD
                            <form id="form-submit" action="http://localhost/venue/popular.php" method="post">
=======
                            <form id="form-submit" action="popular.php" method="post">
>>>>>>> master
                                <div class="row">
                                    <div class="col-md-9">
                                        <fieldset>
                                            <input name="location" type="text" class="form-control" id="location" placeholder="Type location..." required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="btn">Search Now</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="banner-caption">
                            <div class="line-dec"></div>
                            <h2>Best Finder For You</h2>
                            <span>Don't know where to travel? We got you!</span>
                            <div class="blue-button">
                                <a class="scrollTo" data-scrollTo="popular" href="popular.php">Discover More</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <script src="mine.js?v=<?php echo time();?>"></script>
    </body>
</html>