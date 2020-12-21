<?php 
 session_start();
 require("../../php/function/test_user.php");
 if(!test_logged())
 {
 	header('Location: ../');
	exit();
 }
 require("../../php/db/co_db.php");
 $page = "new_slide";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Nouvelle slide</title>
		<link rel="stylesheet" type="text/css" href="../../src/css/global_theme.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../img/logo_aies.png"/>
	</head>

<body>