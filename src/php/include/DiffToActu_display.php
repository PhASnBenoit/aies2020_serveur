<?php
	$date_deb = "" . date('Y') . date('m') . date('d') . date('H') . date('i');
	$req = $db->query("UPDATE slidezone SET date_start = '" . $date_deb . "', state = 'actif' WHERE id = " . $_GET['slide']);
	header("Location: ./display.php?notif=ok");
	exit();
?>