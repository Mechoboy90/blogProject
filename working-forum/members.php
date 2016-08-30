<?php
session_start();
require ('connect.php');
if (@$_SESSION["username"]) {

    ?>

    <?php
    echo "<body style='background: url(images/shutterstock_76800454.jpg) center;'>";
    ?>

    <html>
    <head>
        <title>Home Page</title>
    </head>
    <?php include ("header.php");
    $conect = mysqli_connect('localhost', 'root', '');
    echo "<center><h1>Members</h1>";
    $check = mysqli_query($conect ,"SELECT * FROM forum.users");
    $rows = mysqli_num_rows($check);

    while ($row = mysqli_fetch_assoc($check)) {
        $id = $row['id'];
        echo "<a href='profile.php?id=$id'>".$row['username']."</a><br/>";
    }
    echo "</center>"
    ?>
    <body>
    </body>
    </html>
    <?php
    if (@$_GET['action'] == "logout") {
        session_destroy();
        header("Location: login.php");
    }
}else {
    echo "You must be logged in.";
}
?>