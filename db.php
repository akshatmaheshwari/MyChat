<?php
$servername = "localhost";
$username = "root";
$password = "password";

$conn = mysql_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysql_select_db('mychat');
?>