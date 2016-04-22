<?php
session_start();

require_once( "db.php" );
$sender = $_SESSION['user'];
$receiver = $_SESSION['friend_id'];
$message = $_GET['msg'];

date_default_timezone_set("Asia/Kolkata");
$query = "INSERT INTO messages (sender_id, receiver_id, message, sent_time, recvd_time) VALUES ('$sender', '$receiver', '$message', now(), '');";

mysql_query($query, $conn);

?>