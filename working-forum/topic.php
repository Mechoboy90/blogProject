<?php
session_start();
require ('connect.php');
if (@$_SESSION["username"]) {

    ?>
    <html>
    <head>
        <title>Home Page</title>
    </head>
    <?php include ("header.php"); ?>
    <center>
        </br>
        <a href="post.php"><button>Post topic</button></a>
        </br>

    <?php
    $conect = mysqli_connect('localhost', 'root', '');
        if ($_GET['id']) {
            $check = mysqli_query($conect ,"SELECT * FROM forum.topics WHERE topic_id='".$_GET['id']."'");

            if (mysqli_num_rows($check)) {
                while ($row = mysqli_fetch_assoc($check)){
                $check_u = mysqli_query($conect, "SELECT * FROM forum.users WHERE username='".$row['topic_creator']."'");
                while ($row_u = mysqli_fetch_assoc($check_u)) {
                    $user_id = $row_u['id'];
                }
                    echo "<h1>".$row['topic_name']."</h1>";
                    echo "<h5>By <a href='profile.php?id=$user_id'>".$row['topic_creator']."</a></br>Date: ".$row['date']."</h5>";
                    echo "</br>".$row['topic_content'];
                }
            } else {
                echo "Topic not found.";
            }
        }else {
            header("Location: index.php");
        }

    ?>
    <body>
    <?php
    $mysqli = new mysqli('localhost', 'root', '');
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    if (isset($_GET['message'])) {

        $user=$mysqli->real_escape_string($_GET['user']);
        $message=$mysqli->real_escape_string($_GET['message']);
        $date=date('Y-m-d H:i:s');

        $sql="INSERT INTO forum.comments(id, user, message, date) VALUES(0,'$user','$message','$date')";
        $mysqli->query($sql);
    }

    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PHP and MySql</title>
    </head>


    <h3>Comments:</h3>

    <?php
    $sql = "SELECT * FROM forum.comments";
    $conect = mysqli_connect('localhost', 'root', '');
    $result = mysqli_query($conect ,$sql);

    while($row = mysqli_fetch_assoc($result)) {
        echo $row['user'].',  '.$row['date'].' <br />';
        echo $row['message'].'<br />';
        echo '------------------------ <br />';
    }
    ?>

    <form method="get" action="">
        <p>User:
            <label for="user"></label>
            <input type="text" name="user" id="user" />
            <br />
        </p>
        <p>Message: <br />
            <label for="message"></label>
            <textarea name="message" id="message" cols="45" rows="5"></textarea>
        </p>
        <p>
            <input type="submit" name="submit" id="submit" value="Post comment" />
        </p>
    </form>
    </html>
    </body>
    </html>
    <?php

}else {
    echo "You must be logged in.";
}
?>