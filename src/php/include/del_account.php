<?php
	$user_del = $db->query("DELETE FROM users WHERE ID=" . $_GET['id']);
	header("Location: ./account.php?notif=ok");
	exit();
?>