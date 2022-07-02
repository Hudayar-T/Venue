<?php

    if(isset($_POST['location']))
    {
        $con = mysqli_connect('localhost', 'root', '', 'venue');
        $query_run = mysqli_query($con, "SELECT * FROM locations WHERE location LIKE '%". $_POST['location'] ."%'");
        if(mysqli_num_rows($query_run) != null)
        {
            while($query_row = mysqli_fetch_assoc($query_run))
            {
                $query_row['location'][0] = strtoupper($query_row['location'][0]);
                $onclick = 'onclick = "this.parentNode.parentNode.parentNode.children[0].children[0].children[0].children[0].value = \''. $query_row['location'] .'\'; $(\'#search_result\').hide(); document.getElementById(\'search_result_background\').remove()"';
                echo '<div style="border-bottom: 1px solid black; padding: 10px; cursor: pointer;" id="search_resul"'. $onclick. '>' . $query_row['location'] . '</div>';
            }
        }
    }

    if(isset($_POST['register_email']))
    {
        $name = $_POST['full_name'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];
        $true = true;
        $user_id = 1;
        //$_FILES['pfp']['name'])['extension'];

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
    }

    if(isset($_POST['login_email']))
    {
        session_start();
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $con = mysqli_connect('localhost', 'root', '', 'venue');
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
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['pfp']);
    }

?>