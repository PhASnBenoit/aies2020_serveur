<?php
if(isset($_GET['notif']))
{
	if($_GET['notif'] == "ok")
	{
		$notif = "G:Opération effectuée avec succès !";
	}
}
?>
<div id="main_account">
	<div id="data_contenair">
		<table>
			<tr><th>Nom</th><th>Droit</th><th>Pseudo</th><th>Mot de passe</th><th>Date création</th><th>Modifier</th><th>Supprimer</th></tr>
			<?php
				$req_user = $db->query("SELECT * FROM users WHERE Permission != 'admin' ORDER BY Permission ASC");
				while($data_user = $req_user->fetch())
				{
					echo "<tr class=\"tr_user\"><td>" . $data_user['Common_Name'] . "</td><td>" . $data_user['Permission'] . "</td><td>" . $data_user['Username'] . "</td><td style=\"font-size: 1.25vmax;\">******</td><td>" . reverse_date($data_user['Created_Date'], true) . "</td><td><a href=\"./account.php?action=modif&id=" . $data_user['ID'] . "\"><img src=\"../../src/img/crayon.png\" alt=\"modif\"></a></td><td><a href=\"./account.php?action=del&id=" . $data_user['ID'] . "\"><img src=\"../../src/img/delete.png\" alt=\"sup\"></a></td></tr>";
				}
			?>
		</table>
	</div>

	<button onclick="window.location='./account.php?action=new';"><img src="../../src/img/plus.png" alt=""> Ajouter un compte</button>
</div>
