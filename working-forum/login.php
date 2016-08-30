<html>
<head><title>Login with your account</title></head>
<body>
    <form action="login.php" method="POST">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="Login" name="submit">
    </form>
</body>
</html>

<?php
session_start();
require ("connect.php");
$username = @$_POST['username'];
$password = @$_POST['password'];
$conect = mysqli_connect('localhost', 'root', '');

if (isset($_POST['submit'])) {
    if ($username && $password) {
        $check = mysqli_query($conect, "SELECT * FROM forum.users WHERE username='$username'");
        $rows = mysqli_num_rows($check);

        if (mysqli_num_rows($check) != 0) {
            while ($row = mysqli_fetch_assoc($check)) {
                $db_username = $row['username'];
                $db_password = $row['password'];
            }
            if ($username == $db_username && sha1($password) == $db_password) {
                @$_SESSION["username"] = $username;
                header("Location: index.php");
            } else {
                echo "Your password is wrong.";
            }
        } else {
            echo "Could not find username.";
        }
    } else {
        echo "Please fill in all the fields.";
    }
}
?>