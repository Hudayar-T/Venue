<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Popular Places</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="templatemo-style.css?v=<?php echo time(); ?>">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/fontawesome-min.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/fontAwesome.css">
</head>
<body>

    <div class="wrap" id="wrap">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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
                    <div class="submit-form" id="ijefu" style="margin-top: 3vh">
                        <div id="form-submit">
                            <div class="row" style="padding-bottom: 1vh">
                                <div class="col-md-9">
                                    <fieldset>
                                        <input name="location" type="text" class="form-control" id="locationn" placeholder="Type location..." required="" value="<?php
                                            if(isset($_POST['location'])) echo $_POST['location'];
                                        ?>">
                                    </fieldset>
                                </div>
                                
                                <div class="col-md-3">
                                    <fieldset>
                                        <button type="submit" id="form-submit-button" class="btn">Search Now</button>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="db_content">
        <?php
        
            $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
            $query_run = mysqli_query($con, 'SELECT * FROM locations ORDER BY rating DESC, rating_count DESC');
            if(mysqli_num_rows($query_run) != null)
            {
                while($query_row = mysqli_fetch_assoc($query_run))
                {
                    $location = $query_row['location'];
                    $location[0] = strtoupper($location[0]);
                    $rating = $query_row['rating'];
                    for($i=0; $i<strlen($location); $i++)
                    {
                        if($location[$i] == ' ') $location[$i+1] = strtoupper($location[$i+1]);
                    }
                    echo '<a target="blank" href="example.php?location_id='. $query_row['location_id'] .'" style="text-decoration:none;"><div id="'. strtolower($location) .'" class="content" style="display: flex; flex-direction: column; align-items: center;">';
                    echo '<h1 style="color: lightblue; font-size: 6rem; margin-top: 10vh; width:100%">'. $location .'</h1>';
                    echo '<div id="photos">';
                    $query_run2 = mysqli_query($con, 'SELECT * FROM photos WHERE location_id="'. $query_row['location_id'] .'"');
                    if(mysqli_num_rows($query_run) != null)
                    {
                        while($query_row2 = mysqli_fetch_assoc($query_run2))
                        {
                            echo '<img src="'. $query_row2['photo_dir'] .'" alt="'. $query_row2['photo_id'] .'" style="border: 2px solid black" /> ';
                        }
                    }
                    echo '
                        <div class="photos_rating" rating="'. $rating .'">
                            <div style="padding-left: 1vw; float:left;" ><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                            <div style="padding-left: 1vw; float:left;" ><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                            <div style="padding-left: 1vw; float:left;" ><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                            <div style="padding-left: 1vw; float:left;" ><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                            <div style="padding-left: 1vw; float:left;" ><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                        </div>
                        </div></div></a>';
                }
            }
        
        ?>
        </div>

    </section>
    
    <script src="mine.js?v=<?php echo time(); ?>"></script>
    <script>
        var photos_rating = document.getElementsByClassName('photos_rating')
        for(var i=0; i<photos_rating.length; i++)
        {
            photo_rating = photos_rating[i];
            var rating = photo_rating.getAttribute('rating');
            var j=0
            for(j=0; j<parseInt(rating); j++)
            {
                photo_rating.children[j].children[0].setAttribute('class', 'fa fa-star')
            }
            rating = rating - parseInt(rating)
            if(rating > 0.25 && rating < 0.75) photo_rating.children[j].children[0].setAttribute('class', 'fa fa-star-half-full')
            else if(rating > 0.74) photo_rating.children[j].children[0].setAttribute('class', 'fa fa-star')
        }

        
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
        }

    </script>
</body>
</html>