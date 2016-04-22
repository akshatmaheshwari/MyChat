<?php
require_once 'db.php';

$my_id = $_SESSION['user'];

unset($_SESSION['user']);
unset($_SESSION['friend_id']);
header("Location: login.php");

?>