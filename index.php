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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>

    <body>
    
        <div class="wrap" id="wrap">
            <header id="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="display: flex; justify-content: space-between; align-items: center;">

                            <a href="index.php">
                                <div style="">
                                    <img src="https://live.staticflickr.com/65535/53920110072_e335c9b144_m.jpg" alt="Venue Logo">
                                </div>
                            </a>
                            
                            <nav id="primary-nav" class="dropdown cf">
                                <div id="menu_icon">
                                    <i style="font-size: 4rem;" class="fa fa-bars"></i>
                                </div>
                                <ul class="dropdown menu" id="menu">
                                    <li><a href="index.php">Главная</a></li>
                                    <li><a href="add.php">Поделиться</a></li>
                                    <li><a href="popular.php">Лучшие места</a></li>
                                    <li id="login">
                                        <a style="cursor: pointer;">
                                        <?php
                                            if(isset($_SESSION['user_id'])) echo 'Выйти';
                                            else echo 'Войти';
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
                        <div id="mobile_menu">
                            <ul>
                                <li><a href="index.php">Главная</a></li>
                                <li><a href="add.php">Поделиться</a></li>
                                <li><a href="popular.php">Лучшие места</a></li>
                                <li id="moblogin">
                                    <a style="cursor: pointer;">
                                    <?php
                                        if(isset($_SESSION['user_id'])) echo 'Выйти';
                                        else echo 'Войти';
                                    ?>
                                    </a>
                                </li>
                                <?php
                                    if(!isset($_SESSION['user_id'])) echo '
                                    <li id="mobregister">
                                        <a style="cursor: pointer">
                                            Зарегистрироваться
                                        </a>
                                    </li>';
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <section class="banner" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="submit-form" id="ijefu" style="margin-top: 3vh">
                            <div class="row" style="padding-bottom: 1vh; width: 100%;">
                                <form action="popular.php" method="post">
                                        <div class="col-md-9">
                                            <fieldset>
                                                <input name="location" type="text" class="form-control" id="locationn" placeholder="Напишите название города..." required="" value="">
                                            </fieldset>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <fieldset>
                                                <button type="submit" id="form-submit-button" class="btn">Поиск</button>
                                            </fieldset>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="banner-caption">
                            <div class="line-dec"></div>
                            <h2>Путешествуй с умом</h2>
                            <span>Не знаете куда путешествовать? Не беспокойтесь!</span>
                            <div class="blue-button">
                                <a class="scrollTo" data-scrollTo="popular" href="popular.php">Лучшие места</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <script src="mine.js?v=<?php echo time();?>"></script>
    </body>
</html>