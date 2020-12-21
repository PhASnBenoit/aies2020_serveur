<?php
// v1.1 by PhA 2019-02-05
session_start();
require("../../src/php/function/test_user.php");
if(!test_logged() or !isA())
{
	header('Location: ../');
 	exit();
}

include("../../src/php/function/top_notif.php");
include("../../src/php/tool/logout.php");
require("../../src/php/db/co_db.php");
require("../../src/php/function/reverse_date.php");
require("../../src/php/function/test_str.php");

$page = "account";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Compte</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/common_logged.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/account.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../src/img/logo_aies.png"/>
	</head>

	<body>
		<?php require("../../src/php/include/main_menu_admin.php"); ?>
		<div id="main-content">
			<?php
				  if(isset($_GET['action']))
				  {
				  		switch ($_GET['action']) 
				  		{
				  			case "new":
				  				require("../../src/php/include/new_account.php");
				  			break;

				  			case "modif":
				  				require("../../src/php/include/modif_account.php");
				  			break;

				  			case "del":
				  				require("../../src/php/include/del_account.php");
				  			break;

				  			default:
				  				require("../../src/php/include/main_account.php");
				  			break;
				  		}
				  }
				  else
				  {
				  		require("../../src/php/include/main_account.php");
				  }
			?>
		</div>
		<?php notif($notif); //Gestion des messages top_notif -> ne pas oublier son include ! ?>
		</div>
	</body>
</html>
