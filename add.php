<?php session_start(); 
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Add Place</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="templatemo-style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/fontawesome-min.css">
    
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
                                <img src="https://drive.google.com/uc?export=view&id=1dNONzGxU2kLCbZaGifdFIpKEenn7vsKh" alt="Venue Logo">
                            </div>
                        </a>
                        <nav id="primary-nav" class="dropdown cf">
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
                    <h1 id="add_letter" style="color: rgb(227, 228, 163); margin-top: 5vh">Have you been somewhere? We'd love to know it!</h1>
                    <div class="submit-form" id="ijefu" style="margin-top: 3vh; padding: 0; border: none; background: none;">
                        <form id="form-submit" action="" method="post" enctype="multipart/form-data">
                            <div class="row" style="background: #fff">
                                <div style="width: 100%; padding: 1vh 1vw;">
                                    <fieldset>
                                        <input name="location" type="text" class="form-control" id="location" placeholder="Type location..." required="">
                                    </fieldset>
                                </div>
                                </div>
                            <div class="row" style="background: #fff; z-index: 1000">
                                <div id="search_result" style="display: none; border: 2px solid black; z-index: 999;"></div>
                            </div>
                            <h2 style="color: rgb(227, 228, 163); margin-top: 6vh; margin-bottom: 2vh">Could you share some photos with us :)</h2>
                            
                            <i style="color: white; text-decoration: underline;">Not more than 5 photos</i> 
                            <div class="row" style="background: #fff; padding-top: 3.3vh">
                                <div>
                                        <fieldset>
                                            <input style="cursor:pointer;" name="photo[]" type="file" multiple="multiple" class="form-control" id="location_photo" required="" accept="image/*">
                                        </fieldset>
                                </div>
                            </div>

                            <h2 style="color: rgb(227, 228, 163); margin-top: 6vh; margin-bottom: 2vh">Rating</h2>
                            <div id="rating" style="margin-top: 3vh; cursor: pointer;">
                                <div style="float:left; clear:both;" onmouseenter="Yellow(this)" onmouseleave="Yellow(this, 'fa fa-star-o')" onclick="SendRating(this)"><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="Yellow(this)" onmouseleave="Yellow(this, 'fa fa-star-o')" onclick="SendRating(this)"><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="Yellow(this)" onmouseleave="Yellow(this, 'fa fa-star-o')" onclick="SendRating(this)"><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="Yellow(this)" onmouseleave="Yellow(this, 'fa fa-star-o')" onclick="SendRating(this)"><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                                <div style="padding-left: 1vw; float:left;" onmouseenter="Yellow(this)" onmouseleave="Yellow(this, 'fa fa-star-o')" onclick="SendRating(this)"><i style="color: yellow; font-size: 300%;" class="fa fa-star-o"></i></div>
                            </div>

                            <input type="text" name="rating" id="rating_text" style="display:none">
                            <input type="submit" value="Submit" style="background-color: lightblue; color: black; width: 40vw; margin: 4vh 17vw;">
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
            for(var i = 0; i<5; i++)
            {
                a.parentNode.children[i].removeAttribute('onmouseleave')
                a.parentNode.children[i].removeAttribute('onmouseenter')
                a.parentNode.children[i].removeAttribute('onclick')
                a.parentNode.children[i].style.cursor = "auto"
            }
            $("#rating_text").val(Array.prototype.indexOf.call(a.parentNode.children, a) + 1)
        }
        
        function Yellow(a, b='fa fa-star')
        {
            a=a.children[0];
            for(var i=a.parentNode.parentNode.childElementCount-5; i<=Array.prototype.indexOf.call(a.parentNode.parentNode.children, a.parentNode); i++)
            {
                a.parentNode.parentNode.children[i].children[0].className = b;
            }
        }

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
        $location = strtolower($_POST['location']);
        $location2 = '';
        $location_id = 1;
        $rating2 = 0;
        $rating_count2 = 0;

        $con = mysqli_connect('localhost', 'root', '', 'venue');
        $query_run = mysqli_query($con, 'SELECT * FROM locations');
        if(mysqli_num_rows($query_run) != null)
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
                if($query_row['location'] == $location)
                {
                    $rating2 = $query_row['rating'];
                    $rating_count2 = $query_row['rating_count'];
                    $location2 = $query_row['location'];
                }
                if($location_id < $query_row['location_id'])$location_id = $query_row['location_id'];
            }
            $location_id++;
        }
        if($location2 == '')
        {
            if($_POST['rating'] != '')$sql = 'INSERT INTO locations (location, rating, rating_count) VALUES ("'. $location .'","'. $rating .'","'. $rating_count .'")';
            else $sql = 'INSERT INTO locations (location) VALUES ("'. $location .'")';
            if($con->query($sql) !== TRUE)
            {
                echo 'Error inserting location: ' . $con->error;
            }
        }
        else if($_POST['rating'] != '')
        {
            $rating2 = ($rating2 * $rating_count2 + $rating) / ($rating_count2 + 1);
            $rating_count2+=1;
            $sql = 'UPDATE locations SET rating="'. $rating2 .'", rating_count="'. $rating_count2 .'" WHERE location="'. $location .'"';
            if($con->query($sql) !== TRUE)
            {
                echo 'Error updating rating: ' . $con->error;
            }
        }

        $photo_id = 0;
        $query_run = mysqli_query($con, 'SELECT photo_id FROM photos');
        if(mysqli_num_rows($query_run) != null)
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
                if($photo_id < $query_row['photo_id']) $photo_id = $query_row['photo_id'];
            }
        }
        $photo_id = $photo_id + 1;
        $total_count = sizeof($_FILES['photo']['name']);

        if($total_count < 6)
        {
            for( $i=0 ; $i < $total_count ; $i++ ) 
            {
                $tmpFilePath = $_FILES['photo']['tmp_name'][$i];
                
                if ($tmpFilePath != ""){
                    
                    $newFilePath = "uploads/add/" . $photo_id . "." . pathinfo($_FILES['photo']['name'][$i])['extension'];
                    
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $sql = 'INSERT INTO photos (photo_dir, location_id) VALUES ("'. $newFilePath .'", "'. $location_id .'")';
                        $con->query($sql);
                    }
                }
                $photo_id = $photo_id + 1;
            }
            $string = '<script type="text/javascript">';
            $string .= 'window.location = "popular.php#'. $location .'"';
            $string .= '</script>';

            echo $string;
        }
        else echo '<script>alert("Not more than 5 photos")</script>';
    }

?>

    <script src="mine.js?v=<?php echo time(); ?>"></script>

</body>
</html>

<!--klseonfuiefnisunfsieunfsef-->