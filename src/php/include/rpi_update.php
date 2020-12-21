<?php
	if(isset($_GET['action']) and $_GET['action'] == "deldiff")
	{
		$req = $db->query('SELECT count(*) as nb FROM rpi_update WHERE id = 2 LIMIT 1');
		$data = $req->fetch();
		if($data['nb'] > 0)
		{
			$req2 = $db->query('DELETE FROM rpi_update WHERE id = 2');
			$data2 = $req2->fetch();
			header('Location: ./update.php?u=rpi');
			exit();
		}
	}

	require("../../src/php/function/test_str.php"); //test_str_version / date / heure / minute
	require("../../src/php/function/make_file.php"); //make_file
	$pathfichier = "/rpi/update/";
	if(isset($_POST['version']) and isset($_FILES['file']['name'])) // test POST
	{
		$notif = "B:Un ou plusieurs champs ne sont pas renseignés !";
		if(!empty($_FILES['file']['name']) and !empty($_POST['version'])) // test empty
		{
			$notif = "B:Le format de la version n'est pas bon : xx.xx ! Exemple: 5.6 , 45.2 , 3.24 ...";
			if(test_str_version($_POST['version'])) // require test_str.php
			{
				$notif = "B:Le format de la resource n'est pas un \"tgz\" !";
				if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == "tgz")
				{
					if(isset($_POST['checkbox']) and $_POST['checkbox'] == "on") // différé
					{
						$notif = "B:Un ou plusieurs champs de date ne sont pas renseignés !";
						if(isset($_POST['date1']) and isset($_POST['date2']) and isset($_POST['date3']) and !empty($_POST['date1']) and !empty($_POST['date2']) and !empty($_POST['date3']))
						{
							$notif = "B:Erreur dans le champ date : veuillez ne pas entrez une date manuellement et utilisez l'utilitaire prévu. (format : xx/xx/xxxx)";
							if(test_str_calendar($_POST['date1'])) //require test_str.php
							{
								$notif = "B:Erreur dans le champ heure (format : XX) ex: 08 ou 19";
								if(is_numeric($_POST['date2']) and ($_POST['date2'] >= 0 and $_POST['date2'] <= 23))
								{
									$notif = "B:Erreur dans le champ minute (format : XX) ex: 07 ou 53";
									if(is_numeric($_POST['date3']) and ($_POST['date3'] >= 0 and $_POST['date3'] <= 59))
									{
										$notif = "B:Il existe déjà une mise à jour différée, veuillez l'annuler avant d'en créer une autre !";
										$req_test_diff = $db->query("SELECT COUNT(*) as nbdiff FROM rpi_update WHERE id=2");
										$data_test_diff = $req_test_diff->fetch();
										if($data_test_diff['nbdiff'] == 0)
										{
											$req_test_version = $db->query("SELECT version FROM rpi_update WHERE id=1");
											$data_test_version = $req_test_version->fetch();
											$notif = "B:La version de la mise à jour différée doit être supérieure à la version de la MAJ actuelle (permanente)";
											if($data_test_version['version'] < $_POST['version'])
											{
												$path = make_file("file", $_POST['version'], $pathfichier, "../..", "tgz"); // require make_file.php
												$date = "" . date('Y') . date('m') . date('d') . date('H') . date('i');
												$dateinfo = reverse_date(calendarToStandard($_POST['date1']) . "-" . $_POST['date2'] . ":" . $_POST['date3'], false);
												$req = $db->prepare('INSERT INTO rpi_update (id, version, date, date_create, path, size) VALUES (2, :version, :date, :date_create, :path, :size)');
												$req->execute(array('version' => $_POST['version'], 'date' => $dateinfo, 'date_create' => $date, 'path' => $path[0], 'size' => $path[1]));
												$notif = "G:Mise à jour créée avec succès !";
											}
										}
									}
								}
							}
						}
					}
					else 							// permanente
					{
						$notif = "B:Vous ne pouvez pas créer une maj avec une version plus ancienne !";
					    $req = $db->query('SELECT version FROM rpi_update WHERE id = 1 LIMIT 1');
						$data = $req->fetch();
						if($_POST['version'] > $data['version'])
						{
							$req = $db->query('SELECT count(*) as nb, version FROM rpi_update WHERE id = 2 LIMIT 1');
							$data = $req->fetch();
							if($data['nb'] > 0)
							{
								$notif = "B:Vous ne pouvez pas créer une maj avec une version plus élevée que la version de la maj différée actuelle ! Si besoin effacer la.";
								if($_POST['version'] < $data['version'])
								{
									$path = make_file("file", $_POST['version'], $pathfichier, "../..", "tgz"); // require make_file.php
									$date = "" . date('Y') . date('m') . date('d') . date('H') . date('i');
									$req = $db->prepare('UPDATE rpi_update SET version = :version, date = :date, date_create = :date_create, path = :path, size = :size WHERE id = 1');
									$req->execute(array('version' => $_POST['version'], 'date' => $date, 'date_create' => $date, 'path' => $path[0], 'size' => $path[1]));
									$notif = "G:Mise à jour créée avec succès !";
								}
							}
							else
							{
								$path = make_file("file", $_POST['version'], $pathfichier, "../..", "tgz"); // require make_file.php
								$date = "" . date('Y') . date('m') . date('d') . date('H') . date('i');
								$req = $db->prepare('UPDATE rpi_update SET version = :version, date = :date, date_create = :date_create, path = :path, size = :size WHERE id = 1');
								$req->execute(array('version' => $_POST['version'], 'date' => $date, 'date_create' => $date, 'path' => $path[0], 'size' => $path[1]));
								$notif = "G:Mise à jour créée avec succès !";
							}	
						}
					}
				}
			}
		}
		
	}
?>

<script>function file_change(){ document.getElementById("fake_render").innerHTML = document.getElementById("file").value; }
		function changecolor1(){ document.getElementById("fake_file").style.backgroundColor = "rgb(0,43,54)";}
		function changecolor2(){ document.getElementById("fake_file").style.backgroundColor = "rgb(0,43,84)";}
		function checkbox_changed()
		{
			if(document.getElementById("checkbox").checked == true)
			{ 
				document.getElementById("date_checked").style.display = "block";
			}
			else
			{
				document.getElementById("date_checked").style.display = "none";
			}
		}
</script>

<div id="rpi">
	<h1>Mise à jour <span>permanente</span></h1>
	<div class="aff_maj" id="normalmaj">
		<h3><span>Version</span><span>Date création</span><span>Date lancement</span><span style="width:39%;">Path</span></h3>
		<?php
			$req = $db->query('SELECT * FROM rpi_update WHERE id = 1 LIMIT 1');
			$data = $req->fetch();
			echo "<h4><span>" . $data['version'] . "</span><span>" . reverse_date($data['date_create'], true) . "</span><span>" . reverse_date($data['date'], true) . "</span><span style=\"width:39%;\"><a href=\"../.." . $data['path'] . "\">" . $data['path'] . "</a></span>";
		?>
	</div>
	<h1>Mise à jour <span>différée</span></h1>
	<div class="aff_maj" id="sheduledmaj">
		<?php
			$req = $db->query('SELECT count(*) as nb, version, date_create, date, path FROM rpi_update WHERE id = 2 LIMIT 1');
			$data = $req->fetch();
			if($data['nb'] > 0)
			{
				echo "<h3><span>Version</span><span>Date création</span><span>Date lancement</span><span style=\"width:39%;\">Path</span></h3>";
				echo "<h4><span>" . $data['version'] . "</span><span>" . reverse_date($data['date_create'], true) . "</span><span>" . reverse_date($data['date'], true) . "</span><span style=\"width:39%;\"><a href=\"../.." . $data['path'] . "\">" . $data['path'] . "</a> <a href=\"./update.php?u=rpi&action=deldiff\"><img src=\"../../src/img/delete.png\" alt=\"effacer\"/></a></span>";
			}
			else
			{
				echo "<p style=\"text-align:center;margin-top: 0.9vmax;\">Aucune mise à jour différée</p>";
			}
		?>
	</div>
	<div>
		<br><br>
	</div>
	<h1 style="margin-top: -1.5vmax;">Mise à jour : <span>Importation</span></h1>
	<div id="form">
		<form action="./update.php?u=rpi" method="POST" enctype="multipart/form-data">
			<div id="file_system">
				<label for="file" tabindex="0" id="fake_file">Importer fichier !<br>Uniquement .tgz</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
				<input accept="application/x-gtar" onmouseout="changecolor2();" onmouseover="changecolor1();" onchange="file_change()" name="file" id="file" type="file" />
				<br><label id="fake_render">No file</label>
			</div><br>
			<label id="lb_version" for="version">Version : </label><input id="version" type="text" name="version" /><br>
			<label id="checkbox_label" for="checkbox"> Mise à jour différée : </label><input name="checkbox" id="checkbox" onclick="checkbox_changed();" type="checkbox"/><br>
			<div id="date_checked"><label id="date_label1" for="date1">Le </label><input name="date1" id="date1" type="text" value="" maxlength="10" />
			<label id="date_label2" for="date2"> à </label>
			<input name="date2" id="date2" type="text" value="" size="2" maxlength="2" />
			<label id="date3_label" for="date3"> H </label><input name="date3" id="date3" type="text" value="" size="2" maxlength="2" /><label> min</label>
			<div id="calendarMain"></div>
			<script type="text/javascript">
				calInit("calendarMain", "", "date1", "jsCalendar", "day", "selectedDay");
			</script>
			</div>
			<button>Envoyer</button>
		</form>
	</div>
</div>
