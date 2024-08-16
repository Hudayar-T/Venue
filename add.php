<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
    
    <!-- <meta name="description" content=""> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Share Your Travels
    </title>

    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="templatemo-style.css?v=<?php echo time(); ?>">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="jquery-3.4.0.js"></script>
    
    <script src="mine.js?v=<?php echo time(); ?>"></script>

    <link rel="stylesheet" href="css/fontAwesome.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>

    <script>
        if( !parseInt(
            <?php
                if(isset($_SESSION['user_id'])) echo 1;
                else echo 0;
            ?> 
        ))
        {
            alert('You are not logged in')
            location.assign('index.php')
        }
    </script>
    

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
                <div class="col-md-10 col-md-offset-1" style="padding: 0;">
                    <h1 id="add_letter" style="color: rgb(227, 228, 163); margin-top: 5vh; text-align: center;">Tell us where have you been:</h1>
                    <div class="submit-form" id="ijefu" style="margin-top: 3vh; padding: 0; border: none; background: none;">
                        <form id="form-submit" action="" method="post" enctype="multipart/form-data">
                            <div class="row" style="background: #fff">
                                <div style="width: 100%; padding: 1vh 1vw;">
                                    <fieldset>
                                        <input name="location" type="text" class="form-control" id="location" placeholder="Type location..." style="font-size: 18px; color: #646464" required="">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row" style="background: #fff; z-index: 1000">
                                <div id="search_result" style="display: none; border: 2px solid black; z-index: 999;"></div>
                            </div>
                            <h2 style="color: rgb(227, 228, 163); margin-top: 6vh; margin-bottom: 2vh; text-align: center;">Share your photos</h2>
                            
                            <i style="color: white; text-decoration: underline;" id="photos_warning">Not more than 5 photos</i> 
                            <div class="row" style="background: #fff; padding-top: 3.3vh">
                                <div>
                                    <fieldset>
                                        <input style="cursor:pointer;" name="photo[]" type="file" multiple="multiple" class="form-control" id="location_photo" required="" accept="image/*" on>
                                    </fieldset>
                                </div>
                            </div>

                            <h2 style="color: rgb(227, 228, 163); margin-top: 6vh; margin-bottom: 2vh; text-align: center;">How was your experience</h2>
                            <div class="row" style="background: #fff; font-size: 15px; color: #646464">
                                <textarea name="experience" id="experience" rows="5"></textarea>
                            </div>


                            <h2 style="color: rgb(227, 228, 163); margin-top: 6vh; margin-bottom: 2vh">Rating</h2>
                            <div id="rating" style="margin-top: 3vh; cursor: pointer;">
                                <div style="float:left;" onmouseenter="RatingHovered(this)" onmouseleave="RatingUnhovered(this)" onclick="SendRating(this)"><i style="color: yellow; font-size: 4rem;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="RatingHovered(this)" onmouseleave="RatingUnhovered(this)" onclick="SendRating(this)"><i style="color: yellow; font-size: 4rem;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="RatingHovered(this)" onmouseleave="RatingUnhovered(this)" onclick="SendRating(this)"><i style="color: yellow; font-size: 4rem;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="RatingHovered(this)" onmouseleave="RatingUnhovered(this)" onclick="SendRating(this)"><i style="color: yellow; font-size: 4rem;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="RatingHovered(this)" onmouseleave="RatingUnhovered(this)" onclick="SendRating(this)"><i style="color: yellow; font-size: 4rem;" class="fa fa-star-o"></i></div>
                            </div>

                            <input type="text" name="rating" id="rating_text" style="display:none">
                            <input type="submit" value="Submit" style="background-color: lightblue; color: black; width: 40vw; margin: 4vh 15vw;" id="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

        $("#location").on('keyup', function(){
            var location = $('#location');
            if(location.val().length > 2)
            {
                $.post("sheet.php",
                {
                    location: location.val()
                },
                function(data)
                {
                    if(data != "")
                    {
                        $("#search_result").show()
                        $("#search_result").html(data)
                    }
                }
                );
            }
            else
            {
                $("#search_result").hide();
            }
        })

        function SendRating(a)
        {
            document.getElementById("rating_text").value = (Array.prototype.indexOf.call(a.parentNode.children, a) + 1)
            console.log(document.getElementById("rating_text").value)
        }

        // 'fa fa-star-o'

        function RatingHovered(a)
        {
            a=a.children[0];
            for(var i=a.parentNode.parentNode.childElementCount-5; i<=Array.prototype.indexOf.call(a.parentNode.parentNode.children, a.parentNode); i++)
            {
                a.parentNode.parentNode.children[i].children[0].className = 'fa fa-star';
            }
        }
        
        function RatingUnhovered(a)
        {
            let rating = parseInt(document.getElementById("rating_text").value)
            a=a.children[0];
            for(var i=0; i<5; i++)
            {
                a.parentNode.parentNode.children[i].children[0].className = 'fa fa-star-o';
            }
            for(var i=0; i<rating; i++)
            {
                a.parentNode.parentNode.children[i].children[0].className = 'fa fa-star';
            }
        }

        photos = document.getElementById("location_photo")
        submit = document.getElementById("submit")
        photos.addEventListener("change", function () {
            if (photos.files.length > 5) {
                submit.disabled = true;
                document.getElementById("photos_warning").style.color="red"
                return;
            }
            submit.disabled = false;
            document.getElementById("photos_warning").style.color="white"
        });

    </script>

    <style>
        #search_resul:hover{
            background-color: rgba(198, 255, 198, 0.877);
        }
    </style>

<?php
    if(isset($_POST['location']))
    {
        if(isset($_POST['rating']))$rating = $_POST['rating'];
        if(isset($_POST['rating']))$rating_count=1;
        $experience = '';
        if(isset($_POST['experience'])) $experience = $_POST['experience'];
        $location = strtolower($_POST['location']);
        $location_id = 1;
        $rating = $_POST['rating'];
        $rating_count = 1;
        if($rating == '')
        {
            $rating=0;
            $rating_count=0;
        }
        // echo '<script>alert("Rating is: '. $rating .'")</script>';

        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
        // CHECK IF LOCATION ALREADY EXISTED
        $query_run = mysqli_query($con, 'SELECT * FROM locations WHERE location="'. $location .'"');
        if(mysqli_num_rows($query_run) != null)
        {
            $query_row = mysqli_fetch_assoc($query_run);
            $location_id = $query_row['location_id'];
            if($rating)
            {
                $avg_rating = $query_row['rating'];
                $rating_count = $query_row['rating_count'];
                $avg_rating = ($avg_rating * $rating_count + $rating) / ($rating_count + 1);
                $rating_count+=1;
                $sql = 'UPDATE locations SET rating="'. $avg_rating .'", rating_count="'. $rating_count .'" WHERE location="'. $location .'"';
                if($con->query($sql) !== TRUE)
                {
                    echo 'Error updating rating: ' . $con->error;
                }
            }
        }
        else
        {
            $sql = "INSERT INTO locations (`location`, `rating`, `rating_count`) VALUES ('". $location ."', ". $rating .",". $rating_count .")";
            if($con->query($sql) !== TRUE)
            {
                echo 'Error inserting location: ' . $con->error;
            }
            $sql = 'SELECT * FROM locations WHERE location="'. $location .'"';
            $query_run = mysqli_query($con, $sql);
            $query_row = mysqli_fetch_assoc($query_run);
            $location_id = $query_row['location_id'];
        }

        $experience = nl2br($experience);
        // CHECK IF ALREADY COMMENTED TO THIS PLACE
        $query_run = mysqli_query($con, 'SELECT * FROM experiences WHERE location_id="'. $location_id .'" AND user_id="'. $_SESSION['user_id'] .'"');
        if(mysqli_num_rows($query_run) == null)
        {
            $sql = 'INSERT INTO `experiences` (`experience`, `location_id`, `user_id`, `rating`) 
                    values ("'. $experience .'", '. $location_id .', '. $_SESSION['user_id'] .', '. $rating .')';
                    
        }
        else {
            $sql = 'UPDATE `experiences` SET experience="'. $experience .'", rating="'. $rating .'"
                    WHERE location_id="'. $location_id .'" AND user_id="'. $_SESSION['user_id'] .'"';
        }
        
        if($con->query($sql) !== TRUE)
        {
            echo 'Error inserting/updating your experience: ' . $con->error;
        }
        

        $photo_id = 0;
        $query_run = mysqli_query($con, 'SELECT photo_id FROM photos ORDER BY photo_id DESC');
        if(mysqli_num_rows($query_run) != null)
        {
            $query_row = mysqli_fetch_assoc($query_run);
            if($photo_id < $query_row['photo_id']) $photo_id = $query_row['photo_id'];
        }
        $photo_id = $photo_id + 1;
        $total_count = sizeof($_FILES['photo']['name']);

        for( $i=0 ; $i < $total_count ; $i++ ) 
        {
            $tmpFilePath = $_FILES['photo']['tmp_name'][$i];
            
            if ($tmpFilePath != ""){
                $newFilePath = "uploads/add/" . $photo_id . "." . pathinfo($_FILES['photo']['name'][$i])['extension'];
                $sql = 'INSERT INTO photos (photo_dir, location_id, user_id) VALUES ("'. $newFilePath .'", "'. $location_id .'", "'. $_SESSION['user_id'] .'")';
                if($con->query($sql) !== TRUE)
                {
                    echo 'Error inserting photos ' . $con->error;
                }
                move_uploaded_file($tmpFilePath, $newFilePath);
            }
            $photo_id += 1;
        }
        $string = '<script type="text/javascript">';
        $string .= 'window.location = "popular.php#'. $location .'"';
        $string .= '</script>';

        echo $string;
    }

?>


</body>
</html>

<!--klseonfuiefnisunfsieunfsef-->