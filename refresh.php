<?php
require_once("db.php");
$id = intval($_GET['lm']);

$my_id = $_SESSION['user'];
$friend_id = $_SESSION['friend_id'];

date_default_timezone_set("Asia/Kolkata");
$query = "UPDATE `users` SET `last_seen`=now() WHERE id = '$my_id';";
mysql_query($query, $conn);

$arr = array();
$jsonData = '{"results":[';
$query = "SELECT * FROM messages WHERE (id > $id AND (sender_id = '$my_id' AND receiver_id = '$friend_id' OR sender_id = '$friend_id' AND receiver_id = '$my_id'));";
$result = mysql_query($query, $conn);

$line = new stdClass;
if (mysql_num_rows($result) > 0) {
	while($row = mysql_fetch_assoc($result)) {
		$line->id = $row['id'];
		$line->rid = $row['receiver_id'];
		$line->sid = $row['sender_id'];
		$line->message = $row['message'];
		$line->stime = date('H:i:s', strtotime($row['sent_time']));
		$line->rtime = date('H:i:s', strtotime($row['recvd_time']));
		if ($row['receiver_id'] == $my_id) {
			$line->sor = 'r';
		} else if ($row['sender_id'] == $my_id) {
			$line->sor = 's';
		}
		$arr[] = json_encode($line);
	}
}

$jsonData .= implode(",", $arr);

$jsonData .= '],"last_seen":[';
$query = "SELECT last_seen FROM users WHERE id = '$friend_id';";
$result = mysql_query($query, $conn);
$row = mysql_fetch_assoc($result);

$ls = $row['last_seen'];
$jsonData .= ("{\"ls\":\"" . $ls . "\"}");

$jsonData .= ']}';
print $jsonData;
?>