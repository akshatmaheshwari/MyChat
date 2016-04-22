<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();

	$my_id = -1;
	if (!isset($_SESSION['user'])) {
		$_SESSION['user'] = $_POST['id'];
	}
	header("Location: index.php");

} else if (!isset($_SESSION['user'])) {
	header('Location: login.php');
}

$my_id = $_SESSION['user'];
$sql = 'SELECT * FROM `users` WHERE `id` = ' . $my_id . ';';
$retval = mysql_query($sql, $conn);
$row = mysql_fetch_array($retval, MYSQL_ASSOC);
$my_name = $row['name'];
$my_dp = $row['display_picture'];

$sql = 'SELECT * FROM `users` WHERE `id` <> ' . $my_id . ';';
?>

<!DOCTYPE html>
<html>
<head>
	<title>MyChat</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<script type="text/javascript" src="scripts/script.js"></script>
	<script type="text/javascript">
	function scrollToEnd() {
		document.getElementById("conversation-box").scrollTop = document.getElementById("conversation-box").scrollHeight;
	}
	</script>
</head>
<body>

<div id="side">
	<header>
		<?php if ($my_dp == '') { ?>
		<img src=<?php echo '"images/default_dp.jpeg"'; ?> id="img-user-dp" onclick="showDP(this.src)">
		<?php } else { ?>
		<img src=<?php echo '"images/' . $my_dp . '"'; ?> id="img-user-dp" onclick="showDP(this.src)">
		<?php } ?>
		<img src="images/vertical-dots.png" id="img-vertical-dots-1" class="icon" title="Menu" onclick="showMenuGeneral()">
		<img src="images/plus.png" id="img-plus" class="icon" title="New chat">
	</header>
	<div id="chat-search">
		<input type="search" id="input-search" placeholder="Search chat" title="Search chat">
	</div>
	<div id="chat-list">
		<?php
		$retval = mysql_query($sql, $conn);
		if(!$retval) {
			die('Could not get data: ' . mysql_error());
		}
		if (isset($_GET['f'])) {
			$_SESSION['friend_id'] = $_GET['f'];
		} else if (!isset($_SESSION['friend_id'])) {
			$row = mysql_fetch_array($retval, MYSQL_ASSOC);
			$_SESSION['friend_id'] = $row['id'];
			mysql_data_seek($retval, 0);
		}
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
		?>
		<div id="chat-list-item" onclick=<?php echo '"location.href = \'index.php?f=' . $row['id'] . '\'"'; ?>>
			<?php if ($row['display_picture'] != '') { ?>
			<img src=<?php echo '"images/' . $row['display_picture'] . '"'; ?> id="img-chat-dp">
			<?php } else { ?>
			<img src=<?php echo '"images/default_dp.jpeg"'; ?> id="img-chat-dp">
			<?php } ?>
			<div id="chat-name"><?php echo $row['name']; ?></div>
			<div id="first-message">&nbsp;</div>
		</div>
		<?php
		}
		?>
	</div>
</div>
<div id="main">
	<header>
		<?php
		$f_query = "SELECT * FROM users WHERE id = '" . $_SESSION['friend_id'] . "';";
		$f_rs = mysql_query($f_query, $conn);
		$f_row = mysql_fetch_array($f_rs, MYSQL_ASSOC);
		if ($f_row['display_picture'] != '') {
		?>
		<img src=<?php echo '"images/' . $f_row['display_picture'] . '"'; ?> id="img-chat-dp" onclick="showDP(this.src)">
		<?php } else { ?>
		<img src=<?php echo '"images/default_dp.jpeg"'; ?> id="img-chat-dp" onclick="showDP(this.src)">
		<?php
		}
		?>
		<p id="chat-name"><b><?php echo $f_row['name']; ?></b></p>
		<br>
		<p id="last-seen">-</p>
		<img src="images/vertical-dots.png" id="img-vertical-dots-2" class="icon" title="Menu" onclick="showMenuChat()">
		<img src="images/attach.png" id="img-attach" class="icon" title="Attach">
	</header>
	<div id="conversation-box">
		<script type="text/javascript">
		lastMessageId = 0;
		function getMessages() {
			var req = new XMLHttpRequest();
			req.onreadystatechange = function() {
				if (req.readyState == 4 && req.status == 200) {
					console.log(req.responseText);
					var jsonData = JSON.parse(req.responseText);
					var jsonLength = jsonData.results.length;
					var html = "";
					for (var i = 0; i < jsonLength; i++) {
						var result = jsonData.results[i];
						div = document.createElement('div');
						if (result.sor == 'r') {
							div.id = "received-message";
						} else if (result.sor == 's') {
							div.id = "sent-message";
						}
						p = document.createElement('p');
						p.innerHTML = result.message;
						div.appendChild(p);
						document.getElementById('conversation-box').appendChild(div);
						scrollToEnd();
						lastMessageId = result.id;
					}
					var t = jsonData.last_seen[0].ls.split(/[- :]/);
					var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
					var d_now = new Date();
					if ((d_now - d) / 1000 < 2) {
						document.getElementById('last-seen').innerHTML = "online";
					} else {
						dt = d.getDate();
						mt = d.getMonth() + 1;
						yr = d.getFullYear() - 2000;
						h = d.getHours();
						m = d.getMinutes();
						if (h >= 12) {
							aop = 'pm';
							h -= 12;
						} else {
							aop = 'am';
						}
						if (dt < 10) {
							dt = '0' + dt;
						}
						if (mt < 10) {
							mt = '0' + mt;
						}
						if (m < 10) {
							m = '0' + m;
						}
						if (m == 0) {
							m = '00';
						}
						if (h < 10) {
							h = '0' + h;
						}
						if (h == 0) {
							h = '12';
						}
						document.getElementById('last-seen').innerHTML = ("last seen on " + dt + '/' + mt + '/' + yr + " at " + h + ':' + m + aop);
					}
				}
			}
			req.open("GET", "refresh.php?lm=" + lastMessageId, true);
			req.send();
		}
		getMessages();
		setInterval(function () { getMessages() }, 1000);
		</script>
	</div>
	<footer>
		<img src="images/smiley.png" id="img-smiley" class="icon">
		<input type="text" autocomplete="off" id="type-message" placeholder="Type a message" name="message" />
		<img src="images/send.png" id="img-send" class="icon" onclick="sendMessage()" />
		<?php
		if(isset($_POST['send_message'])) {
			$sender_id = $_POST['sender'];
			$receiver_id = $_POST['receiver'];
			$msg = addslashes($_POST['message']);
			$msg_query = "INSERT INTO messages (sender_id, receiver_id, message, sent_time, recvd_time) VALUES ('$sender_id', '" . $_SESSION['friend_id'] . "', '$msg', '', '');";
			$run = mysql_query($msg_query);
		}
		?>
	</footer>
</div>

<script type="text/javascript">
document.getElementById("type-message").addEventListener("keypress", function () {
	if (event.keyCode == 13) {
		sendMessage();
	}
});

function sendMessage() {
	message = document.getElementById("type-message").value.trim();
	if (message != "") {
		document.getElementById("type-message").value = "";
		var req = new XMLHttpRequest();
		req.open("GET", "submit.php?msg=" + encodeURIComponent(message), true);
		req.send();
	}
}

function showDP(src) {
	div = document.createElement("div");
	div.id = "expanded-image";
	img = document.createElement("img");
	img.src = src;
	div.appendChild(img);
	document.body.appendChild(div);
	flag1 = false;
	document.body.addEventListener('click', hideImage);
}

function hideImage() {
	if (flag1) {
		div.remove();
		flag1 = false;
		document.removeEventListener(hideImage);
	} else {
		flag1 = true;
	}
}

</script>

</body>
</html>