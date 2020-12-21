<?php
// v1.1 by PhA 2019-02-05
session_start();
require("../../src/php/function/test_user.php");
if(!test_logged() or !isA())
{
	header('Location: ../');
 	exit();
}

$page = "admin";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/common_logged.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/admin.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../src/img/logo_aies.png"/>
	</head>

	<body>
		<?php require("../../src/php/include/main_menu_admin.php"); ?>
		<div id="main-content">
			<img src="../../src/img/logo_aies.png" width="600vmax" alt="" style="margin-left: 22vmax;margin-top: 10vmax;"/>
		</div>
	</body>
</html>
