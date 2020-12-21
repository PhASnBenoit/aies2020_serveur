<?php
	$req = $db->query("UPDATE slidezone SET state = 'arch', date_start = '---', date_stop = '---' WHERE id = " . $_GET['slide']);
	header("Location: ./display.php?notif=ok");
	exit();
?>