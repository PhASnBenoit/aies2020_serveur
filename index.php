<?php
	session_start();
	if(!isset($_SESSION['account']))
	{
		$_SESSION['account'] = "guest";
	}
	if($_SESSION['account'] == "logged")
	{
		header('Location: panel/');
		exit();
	}
	$aff = "";
	if(isset($_POST['username']) and isset($_POST['password']))
	{
		$aff = "Un des champs est vide !";
		if(!empty($_POST['username']) and !empty($_POST['password']))
		{
			require("src/php/function/test_str.php");
			require("src/php/db/co_db.php");
			$aff = "Les informations contiennent des caractères invalides !";
			if(test_str($_POST['username']) and test_str($_POST['password']))
			{
				$aff = "Ereur dans la combinaison Identifiant/Mot de passe !";
				$hash_password = sha1("lab" . $_POST['password'] . "aies");
				$req = $db->prepare('SELECT count(*) as nbligne FROM users WHERE Username = :Username and Password = :Password');
				$req->execute(array('Username' => $_POST['username'], 'Password' => $hash_password));
				$data = $req->fetch();
				if($data['nbligne'] > 0)
				{	
					$req2 = $db->prepare('SELECT Common_Name, Permission FROM users WHERE Username = :Username and Password = :Password LIMIT 1');
					$req2->execute(array('Username' => $_POST['username'], 'Password' => $hash_password));
					$data2 = $req2->fetch();
					$_SESSION['account'] = "logged";
					$_SESSION['type'] = $data2['Permission'];
					$_SESSION['common'] = $data2['Common_Name'];
					header('Location: panel/');
					exit();
				}
			}			
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Login</title>
		<link rel="stylesheet" type="text/css" href="../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="src/css/login.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="src/img/logo_aies.png"/>
	</head>

	<body>

		<div id="center">
			<div id="logo">
	            <h1>AIES<span> 2020</span></h1>
	            <img src="src/img/logo_lab.png"/>
	    	</div>
		    <br>
		    <div id="form">
		        <form method="POST" action="">
		            <input type="text" placeholder="Nom De Compte" name="username"><br>
		            <input type="password" placeholder="Mot De Passe" name="password"><br>
		            <button>connexion</button>
		            <h3><?php echo $aff;?></h3>
		        </form>
		    </div>
		</div>
	</body>

</html>
