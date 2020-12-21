<?php
	session_start();
	require("../../src/php/function/test_user.php");
	if(!test_logged())
	{
		header('Location: ../../');
		exit();
	}
	require("../../src/php/db/co_db.php");

	$result = "";
	$req = $db->query("SELECT path, time FROM slidezone WHERE zone = " . $_GET['zone'] . " and state = 'actif'");
	while($data = $req->fetch())
	{
		$result = $result . $data['path'] . ";" . $data['time'] . ";";
	}
	echo $result;
?>