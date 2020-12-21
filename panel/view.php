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
 $page = "view";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Visualisation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../src/css/common_logged.css"/>
		<link rel="stylesheet" type="text/css" href="../src/css/view.css"/>
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
					case 'oneslide':
						require("../src/php/include/oneslide_view.php");
					break;
					case 'zone':
						require("../src/php/include/zone_view.php");
					break;
					default:
						header("Location: view.php?action=zone");
						exit();
					break;
				}
			}
			else
			{
				header("Location: view.php?action=zone");
				exit();
			}
		?>
			<div id="select_zone">
				<?php
					$i = 0;
					$req_zones = $db->query("SELECT ID, zones FROM zones");
					while($data_zones = $req_zones->fetch())
					{
						if($data_zones['zones'] == "local_dev") continue;
						$i++;
						$actu = "";
						if(isset($_GET['zone']) and $_GET['zone'] == $i) $actu = "id=\"actu\"";
						echo "<button " . $actu . " onclick=\"window.location='view.php?action=zone&zone=" . $data_zones['ID'] . "'\">" . $data_zones['zones'] . "</button>";
					}
				?>
			</div>
		</div>
		<?php 
			switch($i)
			{
				case 0: $left = 0; break;
				case 1: $left = 82.5 / ($i * 2.2); break;
				case 2: $left = 82.5 / ($i * 2); break;
				case 3: $left = 82.5 / ($i * 1.9); break;
				case 4: $left = 82.5 / ($i * 1.95); break;
				case 5: $left = 82.5 / ($i * 2); break;
				case 6: $left = 82.5 / ($i * 2.25); break;
				case 7: $left = 82.5 / ($i * 2.45); break;
				case 8: $left = 82.5 / ($i * 2.80); break;
			}
		?>
		<style>
			#select_zone button
			{
				margin-left: <?php echo $left; ?>vmax;
			}
		</style>
	</body>
</html> 
