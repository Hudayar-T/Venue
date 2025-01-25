<?php session_start(); //print_r($_COOKIE); ?>
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
        <link rel="icon" type="image/x-icon" href="favicon.ico">
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
                                    <img src="https://live.staticflickr.com/65535/53920110072_e335c9b144_m.jpg" alt="Venue Logo">
                                </div>
                            </a>
                            
                            <nav id="primary-nav" class="dropdown cf">
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
                            <form id="form-submit" action="popular.php" method="post">
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