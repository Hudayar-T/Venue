<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title id="title"><?php 
    
    if(isset($_GET['location_id']))
    {
        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
        $query_run = mysqli_query($con, 'SELECT * FROM locations WHERE location_id="' . $_GET['location_id'] . '"');
        if(mysqli_num_rows($query_run) != null)
        {
            $location = mysqli_fetch_assoc($query_run)['location'];
            $location[0] = strtoupper($location[0]);
            for($i=0; $i<strlen($location); $i++)
            {
                if($location[$i] == ' ') $location[$i+1] = strtoupper($location[$i+1]);
            }

            echo $location;
        }
    }
    else
    {
        echo '404 - Not Found';
    }
    
    ?></title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="templatemo-style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/fontawesome-min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/fontAwesome.css">
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

                                    if(isset($_SESSION['user_id']))
                                    echo '<li><div id="pfp_div" style="margin-top: 27px"><img id="pfp" src="'. $_SESSION['pfp'] .'" alt="" srcset=""></div></li>';
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>

    <section class="banner" id="top">
        <div class="db_content" style="padding-top: 15px; display: flex; flex-direction: column; align-items: center">
            <?php
            
                $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
                $query_run = mysqli_query($con, 'SELECT * FROM locations WHERE location_id=' . $_GET['location_id']);
                if(mysqli_num_rows($query_run) != null)
                {
                    $locations = mysqli_fetch_assoc($query_run);
                    $location = $locations['location'];
                    $rating = $locations['rating'];
                    $rating_count = $locations['rating_count'];
                    $location[0] = strtoupper($location[0]);
                    for($i=0; $i<strlen($location); $i++)
                    {
                        if($location[$i] == ' ') $location[$i+1] = strtoupper($location[$i+1]);
                    }

                    echo '<h1 style="text-align: center; font-size: 6rem; margin: 0 0 10 0;">'. $location .'</h1>';

                    $photos_query = mysqli_query($con, 'SELECT * FROM photos WHERE location_id=' . $_GET['location_id'] . ' ORDER BY user_id');
                    $photos = mysqli_fetch_assoc($photos_query);
                    
                    $prev = 0;
                    $count = mysqli_num_rows($photos_query);
                    while($count>0)
                    {
                        $prev = $photos['user_id'];
                        // Profile pic and name
                        $users_query = mysqli_query($con, "SELECT * FROM users WHERE user_id=" . $photos['user_id']);
                        $users = mysqli_fetch_assoc($users_query);
                        $experience_query = mysqli_query($con, 'SELECT * FROM experiences WHERE location_id=' . $_GET['location_id'] . ' AND user_id=' . $prev);
                        $experience = mysqli_fetch_assoc($experience_query);
                        $rating = $experience['rating'];
                        echo '
                            <div class="person'. $photos['user_id'] .'" style="width: 90vw">
                            <div class="first_line" style="display: flex; justify-content: space-between;">
                                <div class="profile" style="margin-bottom: 1vh">
                                    <div id="pfp_div" style="display: inline-block">
                                        <img id="pfp" src="'. $users['user_photo'] .'" alt="" srcset="">
                                    </div>
                                    <h4 style="justify-content: center; align-items: center; display: inline-block">
                                        '. $users['full_name'] .'
                                    </h4>
                                </div>
                                <div class="rating">';
                                    for ($i=0; $i < $rating; $i++) { 
                                        echo '<div style="padding-left: 1vw; float:left;" ><i style="color: yellow; font-size: 230%;" class="fa fa-star"></i></div>';
                                    }
                                    for ($i=$rating; $i<5; $i++){
                                        echo '<div style="padding-left: 1vw; float:left;" ><i style="color: yellow; font-size: 230%;" class="fa fa-star-o"></i></div>';
                                    }
                        echo    '</div>
                            </div>
                            <div style="margin-bottom: 5vh; display: inline-block; clear: both; border-radius: 10px; padding: 25px; background-color: rgba(128, 128, 128, 0.3); ">
                            ';

                        // Photos
                        echo '<div id="photos" style="border-radius: 10px; max-width: calc(90vw - 50px);">';
                        while($count>0)
                        {
                            if($prev != $photos['user_id']) break;
                            echo '<img src="'. $photos['photo_dir'] .'" alt="'. $photos['photo_id'] .'" style="border: 2px solid black">';
                            $photos = mysqli_fetch_assoc($photos_query);
                            $count=$count-1;
                        }
                        echo '</div>';

                        //  Experience
                        echo '<div class="context" style="clear: both">';
                        echo '<h4 style="margin: 20 0 0 0">';
                        echo $experience['experience'];
                        echo '</h4>';
                        echo '</div></div></div>';
                        // echo '</div>';
                    }
                }
            
            ?>
        </div>
    </section>
    
    <script src="mine.js?v=<?php echo time(); ?>"></script>
    <script>
        // var photos_rating = document.getElementsByClassName('photos_rating')
        // for(var i=0; i<photos_rating.length; i++)
        // {
        //     photo_rating = photos_rating[i];
        //     var rating = photo_rating.getAttribute('rating');
        //     var j=0
        //     for(j=0; j<parseInt(rating); j++)
        //     {
        //         photo_rating.children[j].children[0].setAttribute('class', 'fa fa-star')
        //     }
        //     rating = rating - parseInt(rating)
        //     if(rating > 0.25 && rating < 0.75) photo_rating.children[j].children[0].setAttribute('class', 'fa fa-star-half-full')
        //     else if(rating > 0.74) photo_rating.children[j].children[0].setAttribute('class', 'fa fa-star')
        // }
/*
        
        $('#form-submit-button').click(function(){
            var locationn = document.getElementById('locationn')
            var val = locationn.value;
            var db_content = document.getElementById('db_content')
            for(var i=0; i<db_content.childElementCount; i++)
            {
                var content = db_content.children[i]
                content.style.display = 'block'
            }
            for(var i=0; i<db_content.childElementCount; i++)
            {
                var content = db_content.children[i]
                var text = content.children[0]
                if(text.innerHTML.toLowerCase().search(val.toLowerCase()) == -1)
                {
                    content.style.display = 'none'
                }
            }
            
            var topp = document.getElementById('top')
            var wrap = document.getElementById('wrap')
            topp.style.minHeight = (window.innerHeight - wrap.offsetHeight) + 'px';
        })
        $('#locationn').on('keyup', function(){
            $('#form-submit-button').click()
        })

        if(location.value != '')
        {
            $('#form-submit-button').click()
        }*/

    </script>

    <style>
        #pfp{
            height: 50px;
            width: 50px;
        }
    </style>

</body>
</html>