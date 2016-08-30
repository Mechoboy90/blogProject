<?php
$conect = mysqli_connect('localhost', 'root', '');
if (@$_SESSION['username']) {

?>

<center><a href="index.php">Home Page</a> | <a href="account.php">My account</a> | <a href="members.php">Members</a>| <?php
    $check = mysqli_query($conect ,"SELECT * FROM forum.users WHERE username='".$_SESSION['username']."'");
    $rows = mysqli_num_rows($check);
    while ($row = mysqli_fetch_assoc($check)) {
        $id = $row['id'];
    }
    echo "Logged in as <a href='profile.php?id=$id'>";
    echo @$_SESSION['username']."</a> |";
    ?>
    <a href="index.php?action=logout">Logout</a></center>

<?php
}else {
    header("Location: login.php");
}
?>