<?php
	$req = $db->query("SELECT folder FROM slidezone, theme WHERE slidezone.theme = theme.id and slidezone.id = " . $_GET['slide']);
	$data = $req->fetch();
	header("Location: ../src/theme/" . $data['folder']. "/modif.php?slide=" . $_GET['slide']);
	exit();
?>