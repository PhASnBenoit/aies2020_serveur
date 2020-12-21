 <?php 
 // v1.1 by PhA 2019-02-05
 session_start();
 require("../src/php/function/test_user.php");
 if(!test_logged())
 {
 	header('Location: ../');
	exit();
 }
 if(isU())
 {
 	header('Location: ./');
 	exit();
 }
 include("../src/php/tool/logout.php");
 include("../src/php/function/top_notif.php");
 require("../src/php/db/co_db.php");
 $page = "flash";


 if(isset($_POST['flash']))
 {

 	$get_data = $db->query('SELECT content FROM flash WHERE id = 1');
	$the_data = $get_data->fetch();
	$str = $the_data[0];

	if($str == $_POST['flash'])
	{
		$notif = "B:Rien n'a été changé lors de la dernière validation !";
	}
	else
	{
		$req = $db->prepare('UPDATE flash SET content = :content WHERE id = 1');
		$req->execute(array('content' => $_POST['flash']));
		$notif = "G:Opération réussie : le nouveau message flash est déployé !";
	}

 	
 }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Flash</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../src/css/common_logged.css"/>
		<link rel="stylesheet" type="text/css" href="../src/css/flash.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../src/img/logo_aies.png"/>
	</head>

	<body>
		<?php require("../src/php/include/main_menu.php"); ?>
		<div id="main-content">
			<form action="flash.php" method="POST">
				<textarea name="flash"><?php
						$get_data = $db->query('SELECT content FROM flash WHERE id = 1');
						$the_data = $get_data->fetch();
						echo $the_data[0];
				?></textarea><br>
				<button>Affichez !</button>
			</form>
		</div>
		<?php notif($notif); //Gestion des messages top_notif -> ne pas oublier son include ! ?>
	</body>
</html> 
