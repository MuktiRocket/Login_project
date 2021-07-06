<?php
$uname = "root";
$dbpass = "";
$host = "localhost";
$db = "login_project";


$conn = mysqli_connect("$host", "$uname", "$dbpass", "$db") or die("Database Connection Error");
