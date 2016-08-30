<html>
<head>
    <title>Register</title>
</head>
<body>
<form action="register.php" method="POST">
    Username: <input type="text" name="username">
    <br>Password: <input type="password" name="password">
    <br>Confirm password: <input type="password" name="repassword">
    <br>Email: <input type="text" name="email">
    <br> <input type="submit" name="submit" value="Register"> or <a href="login.php">Login</a>
</form>
</body>
</html>

<?php
require ("connect.php");
$conect = mysqli_connect("localhost", "root", "");
$username = @$_POST['username'];
$password = @$_POST['password'];
$repass = @$_POST['repassword'];
$email = @$_POST['email'];
$date = date("Y-m-d");
$pass_encrypt = sha1($password);

if (isset($_POST['submit'])) {
    if ($username && $password && $repass && $email) {
        if (strlen($username) >= 5 && strlen($username) < 25 && strlen($password) > 6) {
            if ($password == $repass) {
                $db = new mysqli('localhost', 'root', '', 'forum');
                $db->set_charset("utf8");
                if ($db->connect_errno) {
                    die('Cannot connect to database');
                }
                $statement = $db->prepare(
                    "INSERT INTO users(username, password, email, date) VALUES (?, ?, ?, ?)");
                $statement->bind_param("ssss", $username, $pass_encrypt, $email, $date);
                $statement->execute();
                if ($statement->affected_rows == 1){

                    echo "You have been registered. Click <a href='login.php'>here</a> to login";
                }else {
                    echo "Fail";
                }
            }else {
                echo "Password do not match.";
            }
        }else {
            if (strlen($username) < 5 || strlen($username) > 25) {
                echo "Username must be between 5 and 25 characters.";
            }

            if (strlen($password) < 6) {
                echo "Password must be longer than 6 characters.";
            }
        }
    }else {
        echo "Please, fill in all fields.";
    }

}
?>