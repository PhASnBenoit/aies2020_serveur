<?php 
if(isset($_GET['notif']))
{
	switch ($_GET['notif'])
	{
		case 'miss':
			$notif = "B:Des informations sont manquantes, compléter tout les champs !";
		break;
		case 'notsame':
			$notif = "B:Les mots de passe ne sont pas identiques !";
		break;

		case 'exist':
			$notif = "B:Il existe déjà ce nom ou pseudo dans la liste des comptes !";
		break;

		case 'invalid':
			$notif = "B:Il y a des caractères invalides dans le pseudo ou mot de passe, les caractères acceptés sont : a-Z 0-9";
		break;
	}
}


if(isset($_POST['common']) and isset($_POST['username']) and isset($_POST['password1']) and isset($_POST['password2']) and isset($_POST['permission']))
{
	if($_POST['common'] != "Titre / Nom" and $_POST['username'] != "Pseudo" and $_POST['password1'] != "Mot de passe" and $_POST['password2'] != "Retapez mot de passe")
	{
		if($_POST['password1'] == $_POST['password2'])
		{
			if(test_str($_POST['password1']) and test_str($_POST['username']))
			{
				$req_actualusers = $db->query("SELECT COUNT(*) as nb FROM users WHERE ID <> " . $_GET['id'] . " AND (Common_Name = '" . $_POST['common'] . "' OR Username = '" . $_POST['username'] . "')");
				$data_actualusers = $req_actualusers->fetch();
				if($data_actualusers['nb'] == 0)
				{
					$date_create = "" . date('Y') . date('m') . date('d') . date('H') . date('i');
					$password = sha1("lab" . $_POST['password1'] . "aies");
					$senddata = $db->prepare("UPDATE users SET Username = :username, Common_Name = :common, Permission = :permission, Password = :password, Created_Date = :datecreate WHERE ID = " . $_GET['id']);
					$senddata->execute(array(
									"username" => $_POST['username'],
									"common" => $_POST['common'],
									"permission" => $_POST['permission'],
									"password" => $password,
									"datecreate" => $date_create));
					header("Location: ./account.php?notif=ok");
					exit();
				}
				else
				{
					header('Location: ./account.php?action=modif&id=' . $_GET["id"] . '&notif=exist');
					exit();
				}
			}
			else
			{
				header('Location: ./account.php?action=modif&id=' . $_GET["id"] . 'notif=invalid');
				exit();
			}
		}
		else
		{
			header('Location: ./account.php?action=modif&id=' . $_GET["id"] . '&notif=notsame');
			exit();
		}
	}
	else
	{
		header('Location: ./account.php?action=modif&id=' . $_GET["id"] . '&notif=miss');
		exit();
	}
}

$req_a_user = $db->query("SELECT * FROM users WHERE ID = " . $_GET['id'] . " LIMIT 1");
$data_a_user = $req_a_user->fetch();
$a_common = $data_a_user['Common_Name'];
$a_username = $data_a_user['Username'];
$a_permission = $data_a_user['Permission'];

?>
<div id="new_account">
	<h1>Informations du compte</h1>
	<form method="POST" action="./account.php?action=modif&id=<?php echo $_GET['id']; ?>">
		<input type="text" name="common" maxlength="25" value="<?php echo $a_common;?>" onfocus="if(this.value=='Titre / Nom'){this.value=''} this.style.color='black';" onblur="if(this.value==''){this.value = 'Titre / Nom'} this.style.color='grey';"/>
		<input type="text" name="username" maxlength="25" value="<?php echo $a_username;?>" onfocus="if(this.value=='Pseudo'){this.value=''} this.style.color='black';" onblur="if(this.value==''){this.value = 'Pseudo'} this.style.color='grey';"/>
		<input type="text" name="password1" maxlength="25" value="Mot de passe" onfocus="if(this.value=='Mot de passe'){this.value='';this.type='password';}this.style.color='black';" onblur="if(this.value==''){this.value = 'Mot de passe';this.type='text';} this.style.color='grey';"/>
		<input type="text" name="password2" maxlength="25" value="Retapez mot de passe" onfocus="if(this.value=='Retapez mot de passe'){this.value='';this.type='password';}this.style.color='black';" onblur="if(this.value==''){this.value = 'Retapez mot de passe';this.type='text';} this.style.color='grey';"/>
		<select name="permission">
			<option value="user" <?php if($a_permission == "user") echo "selected";?>>Utilisateur</option>
			<option value="moderator" <?php if($a_permission == "moderator") echo "selected";?>>Modérateur</option>
		</select>
		<button>Modifier le compte</button>
	</form>
</div>
