<?php
<<<<<<< HEAD

    if(isset($_POST['location']))
    {
        $con = mysqli_connect('localhost', 'root', '', 'venue');
=======
    
    session_start();

    if(isset($_POST['location']))
    {
        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
>>>>>>> master
        $query_run = mysqli_query($con, "SELECT * FROM locations WHERE location LIKE '%". $_POST['location'] ."%'");
        if(mysqli_num_rows($query_run) != null)
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
                $query_row['location'][0] = strtoupper($query_row['location'][0]);
<<<<<<< HEAD
                $onclick = 'onclick = "this.parentNode.parentNode.parentNode.children[0].children[0].children[0].children[0].value = \''. $query_row['location'] .'\'; $(\'#search_result\').hide(); document.getElementById(\'search_result_background\').remove()"';
                echo '<div style="border-bottom: 1px solid black; padding: 10px; cursor: pointer;" id="search_resul"'. $onclick. '>' . $query_row['location'] . '</div>';
=======
                $onclick = 
                '
                    this.parentNode.parentNode.parentNode
                    .children[0].children[0].children[0].children[0].value = `'. $query_row['location'] .'`; 
                    $(`#search_result`).hide(); 
                    //document.getElementById(`search_result_background`).remove();
                    var location = document.getElementById(`location`);
                    $.post(`sheet.php`,
                    {
                        experience_location: location.value,
                        user_id: '. $_SESSION['user_id'] .'
                    },
                    function(data)
                    {
                        if(data != ``)
                        {
                            console.log(data)
                            document.getElementById(`experience`).innerHTML = data;
                        }
                    }
                    );
                ';
                echo '<div style="border-bottom: 1px solid black; padding: 10px; cursor: pointer;" id="search_resul" onclick="'. $onclick. '">' . $query_row['location'] . '</div>';
>>>>>>> master
            }
        }
    }

<<<<<<< HEAD
    if(isset($_POST['register_email']))
    {
        $name = $_POST['full_name'];
=======
    if(isset($_POST['experience_location']))
    {
        $location = $_POST['experience_location'];
        $user_id = $_POST['user_id'];
        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
        $query_run = mysqli_query($con, "SELECT location_id FROM locations WHERE location='". $location ."'");
        $location_id = mysqli_fetch_assoc($query_run)['location_id'];

        $query_run = mysqli_query($con, "select experience from experiences where location_id='". $location_id ."' and user_id='". $user_id ."'");
        if(mysqli_num_rows($query_run) != null)
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
                echo $query_row['experience'];
            }
        }
        else echo 'Your overall thoughts';
    }

    if(isset($_POST['register_email']))
    {
        $name = $_POST['register_name'];
>>>>>>> master
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];
        $true = true;
        $user_id = 1;
        //$_FILES['pfp']['name'])['extension'];

<<<<<<< HEAD
        $con = mysqli_connect('localhost', 'root', '', 'venue');
        $query_run = mysqli_query($con, "SELECT email, user_id FROM users");
        if(mysqli_num_rows($query_run) != null)
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
               if($query_row['email'] == $email)
               {
                    echo 'This email is already in use.';
                    $true = false;
               }
                if($query_row['user_id']+1 > $user_id) $user_id = $query_row['user_id']+1;
            }
        }

        if(isset($_FILES['pfp'])) move_uploaded_file($_FILES['pfp']['tmp_name'],'uploads/pfp/' . $user_id . '.' . pathinfo($_FILES['pfp']['name'])['extension']);// . uniqid('',true).".".strtolower(end(explode('.',$_FILES['file']['name']))));

        if($true)
        {
            if(isset($_FILES['pfp']))$sql = 'INSERT INTO users (full_name, email, password, user_photo) VALUES ("'. $name .'", "'. $email .'", "'. $password .'", "uploads/pfp/'. $user_id .'.' . pathinfo($_FILES["pfp"]["name"])["extension"] .'")';
            else $sql = 'INSERT INTO users (full_name, email, password, user_photo) VALUES ("'. $name .'", "'. $email .'", "'. $password .'", "uploads/pfp/user.png")';
            $con->query($sql);
        }
=======
        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
        $sql = "SELECT email, user_id FROM users WHERE email='". $email ."'";
        $result = $con->query($sql);
        if($result->num_rows > 0) echo 'email_1';
        else
        {
            // GET MAX USER_ID
            $sql = "SELECT MAX(user_id) AS highest_user_id FROM users";
            $result = $con->query($sql);
            if ($result->num_rows > 0) 
            {
                $row = $result->fetch_assoc();
                $user_id = $row['highest_user_id']+1;
            }

            $pfp_path = "https://live.staticflickr.com/65535/53921919897_c76eb4b3a9_b.jpg";
            echo(isset($_FILES['pfp']));
            if(isset($_FILES['pfp']))
            {
                echo 'pfp is isset';
                move_uploaded_file($_FILES['pfp']['tmp_name'],'uploads/pfp/' . $user_id . '.' . pathinfo($_FILES['pfp']['name'])['extension']);
                $pfp_path = 'uploads/pfp/'. $user_id .'.' . pathinfo($_FILES["pfp"]["name"])["extension"];
            }

            $sql = 'INSERT INTO users (full_name, email, password, user_photo) VALUES ("'. $name .'", "'. $email .'", "'. $password .'", "'. $pfp_path .'")';
            
            if(!$con->query($sql))
            {
                echo $con->error;
            }
        }
        
>>>>>>> master
    }

    if(isset($_POST['login_email']))
    {
<<<<<<< HEAD
        session_start();
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $con = mysqli_connect('localhost', 'root', '', 'venue');
=======
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
>>>>>>> master
        $query_run = mysqli_query($con, 'SELECT * FROM users WHERE email="'. $email .'"and password="'. $password .'"');
        if(mysqli_num_rows($query_run))
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
               $_SESSION['user_id'] = $query_row['user_id'];
               $_SESSION['name'] = $query_row['full_name'];
               $_SESSION['email'] = $query_row['email'];
               $_SESSION['pfp'] = $query_row['user_photo'];
            }
            echo 'refresh';
        }
    }

    if(isset($_POST['logout']))
    {
<<<<<<< HEAD
        session_start();
=======
>>>>>>> master
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['pfp']);
<<<<<<< HEAD
=======
        echo isset($_SESSION['user_id']);
>>>>>>> master
    }

?>