<?php
session_start();
require ('connect.php');
if (@$_SESSION["username"]) {

    ?>

    <?php
    echo "<body style='background: url(images/account-icon-26573140.jpg) center;'>";
    ?>

    <html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>Home Page</title>
    </head>
    <?php include ("header.php"); ?>
    <body>
    <center>
       <p></p>
    <?php
    $check = mysqli_query($conect ,"SELECT * FROM forum.users WHERE username='".$_SESSION['username']."'");
    $rows = mysqli_num_rows($check);
    while ($row = mysqli_fetch_assoc($check)) {
        $username = $row['username'];
        $id = $row['id'];
        $email = $row['email'];
        $date = $row['date'];
        $replies = $row['replies'];
        $score = $row['score'];
        $topics = $row['topics'];
        $prof_pic = $row['profile_pic'];
    }
    ?>
    <?php echo "<img src='$prof_pic' width='70' height='70'>"; ?> </br>
    Username: <?php echo $username; ?> </br>
    ID: <?php echo $id; ?> </br>
    Email: <?php echo $email; ?> </br>
    Date registered: <?php echo $date; ?> </br>
    Replies: <?php echo $replies; ?> </br>
    Score: <?php echo $score; ?> </br>
    Topics: <?php echo $topics; ?> </br> </br>
        <a href="account.php?action=cp">Change password</a></br>
        <a href="account.php?action=ci">Change profile picture</a>
    </center>
    </body>
    </html>
    <?php
    if (@$_GET['action'] == "logout") {
        session_destroy();
        header("Location: login.php");
    }

    if (@$_GET['action'] == "ci") {
        echo "<form action='account.php?action=ci' method='POST' enctype='multipart/form-data'><center><br>
        </br>
         Available file extension <b> .PNG .JPG .JPEG</b></br>
         <input type='file' name='image'></br>
         <input type='submit' name='change_pic' value='Change'>
         </br>
          ";
        if (isset($_POST['change_pic'])) {
            $errors = array();
            $allowed_e = array('png', 'jpg', 'jpeg');

            $file_name = $_FILES['image']['name'];
            $file_e = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_s = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];

            if (in_array($file_e, $allowed_e) === false) {
                $errors[] = "This file extension is not allowed.";
            }

            if ($file_s > 2097152) {
                $errors[] = "File must be under 2 mb";
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, 'images/'.$file_name);
                $image_up = 'images/'.$file_name;
                if ($query = mysqli_query($conect, "UPDATE forum.users SET profile_pic='".$image_up."' WHERE username='".$_SESSION['username']."'")) {
                    echo "Your profile image has changed.";
                }
            } else {
                foreach ($errors as $error) {
                    echo $error, '</br>';
                }
            }
        }

        echo "</form></center>";
    }

    if (@$_GET['action'] == "cp") {
        echo "<form action='account.php?action=cp' method='POST'><center>";
        echo "
        Current password: <input type='text' name='curr_pass'></br>
        New password: <input type='password' name='new_pass'></br>
        Re-type password: <input type='password' name='re_pass'></br>
        <input type='submit' name='change_pass' value='Change'></br>";

        $curr_pass = @$_POST['curr_pass'];
        $new_pass = @$_POST['new_pass'];
        $re_pass = @$_POST['re_pass'];

        if (isset($_POST['change_pass'])) {
            $check = mysqli_query($conect, "SELECT * FROM forum.users WHERE username='" . $_SESSION['username'] . "'");
            $rows = mysqli_num_rows($check);
            while ($row = mysqli_fetch_assoc($check)) {
                $get_pass = $row['password'];
            }
            if (sha1($curr_pass) == $get_pass) {
                if (strlen($new_pass) > 6) {
                    if ($re_pass == $new_pass) {
                        if ($query = mysqli_query($conect, "UPDATE forum.users SET password='".sha1($new_pass)."' WHERE username='".$_SESSION['username']."'")) {
                            echo "Password changed.";
                        }
                    } else {
                        echo "New password do not match.";
                    }
                }else {
                    echo "New password must be longer than 6 characters.";
                }
            } else {
                echo "Your current password do not match with your real password.";
            }
        }
        echo "</center></form>";
    }

}else {
    echo "You must be logged in.";
}
?>