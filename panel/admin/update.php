<?php
// v1.1 by PhA 2019-02-05
session_start();
require("../../src/php/function/test_user.php");
require("../../src/php/function/reverse_date.php");
if(!test_logged() or !isA())
{
	header('Location: ../');
 	exit();
}
require("../../src/php/db/co_db.php");
include("../../src/php/function/top_notif.php");
$page = "update";
$notif = "";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Mise à jour</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/common_logged.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/update.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../src/img/logo_aies.png"/>
		<script type="text/javascript" src="../../src/js/jsSimpleDatePickr.js"></script>
		<script type="text/javascript" src="../../src/js/jsSimpleDatePickrInit.js"></script>
	</head>

	<body>
		<?php require("../../src/php/include/main_menu_admin.php"); ?>
		<div id="main-content">
		<?php 
			if(isset($_GET['u']))
			{
				switch ($_GET['u'])
				{
					case "www":
						require("../../src/php/include/www_update.php"); // a faire
					break;
					case "rpi":
						require("../../src/php/include/rpi_update.php");
					break;
					default:
						require("../../src/php/include/main_update.php");
					break;
				}
			}
			else
			{
				require("../../src/php/include/main_update.php");
			}
		?>
		</div>
		<?php notif($notif); //Gestion des messages top_notif -> ne pas oublier son include ! ?>
	</body>
</html> 
