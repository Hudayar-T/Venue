<?php
    
    session_start();

    if(isset($_POST['location']))
    {
        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
        $query_run = mysqli_query($con, "SELECT * FROM locations WHERE location LIKE '%". $_POST['location'] ."%'");
        if(mysqli_num_rows($query_run) != null)
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
                $query_row['location'][0] = strtoupper($query_row['location'][0]);
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
            }
        }
    }

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
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];
        $true = true;
        $user_id = 1;
        

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

            // echo strval(isset($_FILES['pfp'])) . ' - isset';
            $pfp_path = "https://live.staticflickr.com/65535/53921919897_c76eb4b3a9_b.jpg";
            if(isset($_POST['pfp']))
            {
                // $file = $_POST['pfp'];

                // if ($file['error'] === UPLOAD_ERR_OK) {
                    // $fileTmpPath = $file['tmp_name'];
                    // $fileName = $file['name'];
                    
                    // // Set the upload directory (this could be a path to your cloud storage or local path)
                    // $uploadDir = 'uploads/profile_pictures/';
                    // $newFilePath = $uploadDir . basename($fileName);
            
                    // // Move the file to the desired directory (or cloud storage)
                    // if (move_uploaded_file($fileTmpPath, $newFilePath)) {
                    //     echo 'File successfully uploaded and moved to ' . $newFilePath;
                    // }
                    print_r( $_FILES);
                    // move_uploaded_file($_POST['pfp']['tmp_name'],'uploads/pfp/' . $user_id . '.' . pathinfo($_POST['pfp']['name'])['extension']);
                    // $pfp_path = 'uploads/pfp/'. $user_id .'.' . pathinfo($_POST["pfp"]["name"])["extension"];
                // }
            }

            $sql = 'INSERT INTO users (full_name, email, password, user_photo) VALUES ("'. $name .'", "'. $email .'", "'. $password .'", "'. $pfp_path .'")';
            
            if(!$con->query($sql))
            {
                echo $con->error;
            }
        }
        
    }

    if(isset($_POST['login_email']))
    {
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $con = mysqli_connect('localhost', 'root', '', 'venue', 3307);
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
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['pfp']);
        echo isset($_SESSION['user_id']);
    }

?>