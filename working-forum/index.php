<?php
session_start();
require ('connect.php');
if (@$_SESSION["username"]) {

?>

    <?php
    echo "<body style='background: url(images/forum-icon-21.jpg) center;'>";
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
        </br>
        <?php echo '<table border="1px">'; ?>
        <tr>
            <td>
                <span>ID</span>
            </td>
            <td width="400px;" style="text-align: center;">
                Name
            </td>
            <td width="80px;" style="text-align: center;">
                Views
            </td>
            <td width="80px;" style="text-align: center;">
                Creator
            </td>
            <td width="80px;" style="text-align: center;">
                Date
            </td>
        </tr>
    </center>
    <body>
    </body>
</html>
<?php
    $conect = mysqli_connect('localhost', 'root', '');
    $check = mysqli_query($conect, "SELECT * FROM forum.topics");
    if (!@$_GET['date']) {
        if (mysqli_num_rows($check) != 0) {
            while ($row = mysqli_fetch_assoc($check)) {
                $id = $row['topic_id'];
                echo "<tr>";
                echo "<td>".$row['topic_id']."</td>";
                echo "<td style='text-align: center'><a href='topic.php?id=$id'>".$row['topic_name']."</a></td>";
                echo "<td>".$row['views']."</td>";
                $check_u = mysqli_query($conect, "SELECT * FROM forum.users WHERE username='".$row['topic_creator']."'");
                while ($row_u = mysqli_fetch_assoc($check_u)) {
                    $user_id = $row_u['id'];
                }
                echo "<td><a href='profile.php?id=$user_id'>".$row['topic_creator']."</a></td>";
                $get_date = $row['date'];
                echo "<td><a href='index.php?date=$get_date'>".$row['date']."</a></td>";
                echo "</tr>";
            }
        } else {
            echo "No topic found.";
        }
    }

    if (@$_GET['date']) {
        $check_d = mysqli_query($conect, "SELECT * FROM forum.topics WHERE date='".$_GET['date']."'");

        while ($row_d = mysqli_fetch_assoc($check_d)) {
            $id = $row_d['topic_id'];
            echo "<tr>";
            echo "<td>".$row_d['topic_id']."</td>";
            echo "<td style='text-align: center'><a href='topic.php?id=$id'>".$row_d['topic_name']."</a></td>";
            echo "<td>".$row_d['views']."</td>";
            $check_u = mysqli_query($conect, "SELECT * FROM forum.users WHERE username='".$row_d['topic_creator']."'");
            while ($row_u = mysqli_fetch_assoc($check_u)) {
                $user_id = $row_u['id'];
            }
            echo "<td><a href='profile.php?id=$user_id'>".$row_d['topic_creator']."</a></td>";
            $get_date = $row_d['date'];
            echo "<td><a href='index.php?date=$get_date'>".$row_d['date']."</a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    if (@$_GET['action'] == "logout") {
        session_destroy();
        header("Location: login.php");
    }
}else {
    echo "You must be logged in.";
}
?>