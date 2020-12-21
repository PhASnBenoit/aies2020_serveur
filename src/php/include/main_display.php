<?php /* affichage des retour d'opération via le systeme de notification */
	if(isset($_GET['notif']))
	{
		if($_GET['notif'] == "noexistbutton")
		{
			$notif = "B:Ce bouton n'est pas associé à la diapo de cette catégorie, les boutons utilisablent se situent à droite uniquement d'une catégorie !";
		}
		if($_GET['notif'] == "noslide")
		{
			$notif = "B:Aucune diapo selectionnée !";
		}
		if($_GET['notif'] == "ok")
		{
			$notif = "G:Opération réussie !";
		}
	}
?>
<div id="main_display">
	<script src="../src/js/select_slide.js"></script>
	<div class="state_block" id="actu">
		<div class="content_block">
			<h1>Actif</h1>
			<div class="data_container">
				<table>
					<tr><th>Date</th><th>Titre</th><th>Zone</th><th>Début</th><th>Fin</th><th>Créé par</th><th>Voir</th></tr>
					<?php
						$req_actif = $db->query("SELECT * FROM slidezone, zones WHERE slidezone.zone = zones.idzone and state='actif' ORDER BY date_start DESC");
						while($data_actif = $req_actif->fetch())
						{
							echo "<tr class=\"tr_slide\" onclick=\"tr_click(this, 0, " . $data_actif['id'] . ");\"><td>" . reverse_date($data_actif['date_create'], true) . "</td><td>" . $data_actif['title'] . "</td><td>" . $data_actif['zones'] .  "</td><td>" . reverse_date($data_actif['date_start'], true) . "</td><td>" . reverse_date($data_actif['date_stop'], true) . "</td><td>" . $data_actif['creator'] . "</td><td id=\"img\" style=\"border-right: 0;\"><a href=\"./view.php?action=oneslide&slide=" . $data_actif['id'] . "\"><img src=\"../src/img/visu_eyes.png\" alt=\"Voir\" /></a></td></tr>";
						}
					?>
				</table>
			</div>
		</div>

		<div class="action_block">
			<button onclick="bt_click('ActuToArch');" class="bt_action" style="margin-left: 6.5vmax;margin-top: 7vmax;">Archiver</button>
		</div>
	</div>

	<div class="state_block" id="diff">
		<div class="content_block">
			<h1>Differer</h1>
			<div class="data_container">
				<table>
					<tr><th>Date</th><th>Titre</th><th>Zone</th><th>Début</th><th>Fin</th><th>Créé par</th><th>Voir</th></tr>
					<?php
						$req_diff = $db->query("SELECT * FROM slidezone, zones WHERE slidezone.zone = zones.idzone and state='diff' ORDER BY date_start DESC");
						while($data_diff = $req_diff->fetch())
						{
							echo "<tr class=\"tr_slide\" onclick=\"tr_click(this, 1, " . $data_diff['id'] .");\"><td>" . reverse_date($data_diff['date_create'], true) . "</td><td>" . $data_diff['title'] . "</td><td>" . $data_diff['zones'] .  "</td><td>" . reverse_date($data_diff['date_start'], true) . "</td><td>" . reverse_date($data_diff['date_stop'], true) . "</td><td>" . $data_diff['creator'] . "</td><td id=\"img\" style=\"border-right: 0;\"><a href=\"./view.php?action=oneslide&slide=" . $data_diff['id'] . "\"><img src=\"../src/img/visu_eyes.png\" alt=\"Voir\" /></a></td></tr>";
						}
					?>
				</table>
			</div>
		</div>

		<div class="action_block">
			<button onclick="bt_click('DiffToArch');" class="bt_action" style="margin-left: 3vmax;margin-top: 7vmax;">Archiver</button>
			<button onclick="bt_click('DiffToActu');" class="bt_action" style="margin-left: 2vmax;">Activer</button>
		</div>
	</div>

	<div class="state_block" id="arch">
		<div class="content_block">
			<h1>Archiver</h1>
			<div class="data_container">
				<table>
					<tr><th>Date</th><th>Titre</th><th>Zone</th><th>Crée par</th><th>Voir</th></tr>
					<?php
						$req_arch = $db->query("SELECT * FROM slidezone, zones WHERE slidezone.zone = zones.idzone and state='arch' ORDER BY date_create DESC");
						while($data_arch = $req_arch->fetch())
						{
							echo "<tr class=\"tr_slide\" onclick=\"tr_click(this, 2, " . $data_arch['id'] . ");\"><td>" . reverse_date($data_arch['date_create'], true) . "</td><td>" . $data_arch['title'] . "</td><td>" . $data_arch['zones'] .  "</td><td>" . $data_arch['creator'] . "</td><td id=\"img\" style=\"border-right: 0;\"><a href=\"./view.php?action=oneslide&slide=" . $data_arch['id'] . "\"><img src=\"../src/img/visu_eyes.png\" alt=\"Voir\" /></a></td></tr>";
						}
					?>
				</table>
			</div>
		</div>

		<div class="action_block">
			<button onclick="bt_click('ArchToActuDiff');" class="bt_action" style="margin-top: 4vmax;">Activer/différer</button>
			<button onclick="bt_click('add');" class="bt_action" style="margin-left: 1.5vmax;opacity:1;box-shadow: 0px 0px 15px 1px rgb(100,200,100);">Créer diapo</button><br>
			<button onclick="bt_click('modif');" class="bt_action" style="margin-top: 2.5vmax;">Modifier</button>
			<button onclick="bt_click('del');" class="bt_action" style="margin-left: 4.5vmax;">Supprimer</button>
		</div>
	</div>
</div>
