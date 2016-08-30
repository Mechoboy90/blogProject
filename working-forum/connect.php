<?php
$conect = mysqli_connect("localhost", "root", "") or die("Cannot connect to server.");
mysqli_select_db($conect, "forum") or die("Cannot connect to database.");