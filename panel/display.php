 <?php
 // v1.1 by PhA 2019-02-05
 session_start();
 require("../src/php/function/test_user.php");
 if(!test_logged())
 {
 	header('Location: ../');
	exit();
 }
 include("../src/php/tool/logout.php");
 require("../src/php/db/co_db.php");
 include("../src/php/function/top_notif.php");
 include("../src/php/function/reverse_date.php");
 $page = "display";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Affichage</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../src/css/common_logged.css"/>
		<link rel="stylesheet" type="text/css" href="../src/css/display.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../src/img/logo_aies.png"/>
	</head>

	<body>
		<?php require("../src/php/include/main_menu.php"); ?>
		<div id="main-content">
			<?php
				  if(isset($_GET['action']))
				  {
				  		switch ($_GET['action']) 
				  		{
				  			case "add":
				  				require("../src/php/include/add_display.php");
				  			break;

				  			case "modif":
				  				require("../src/php/include/modif_display.php");
				  			break;

				  			case "del":
				  				require("../src/php/include/del_display.php");
				  			break;

				  			case "ActuToArch":
				  				require("../src/php/include/ActuDiffToArch_display.php");
				  			break;
				  			
				  			case "DiffToArch":
				  				require("../src/php/include/ActuDiffToArch_display.php");
				  			break;

				  			case "DiffToActu":
				  				require("../src/php/include/DiffToActu_display.php");
				  			break;

				  			case "ArchToActuDiff":
				  				require("../src/php/include/ArchToActuDiff_display.php");
				  			break;

				  			default:
				  				require("../src/php/include/main_display.php");
				  			break;
				  		}
				  }
				  else
				  {
				  		require("../src/php/include/main_display.php");
				  }
			?>
		</div>
		<?php notif($notif); //Gestion des messages top_notif -> ne pas oublier son include ! ?>
	</body>
</html>
