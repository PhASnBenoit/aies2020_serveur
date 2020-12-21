<?php
if(isset($_POST["deb"]) and isset($_POST["fin"]) and isset($_POST["day_deb"]) and isset($_POST["hour_deb"]) and isset($_POST["min_deb"]) and isset($_POST["day_fin"]) and isset($_POST["hour_fin"]) and isset($_POST["min_fin"]) and isset($_GET["slide"]))
{
	if($_POST['deb'] == "actu")
	{
		$date_deb = "" . date('Y') . date('m') . date('d') . date('H') . date('i');
		$state = "actif";
	}
	else
	{
		$date_deb = reverse_date(calendarToStandard($_POST['day_deb']) . "-" . on2numeric($_POST['hour_deb']) . ":" . on2numeric($_POST['min_deb']), false);
		$state = "diff";
	}

	if($_POST['fin'] == "actu")
	{
		$date_fin = "---";
	}
	else
	{
		$date_fin = reverse_date(calendarToStandard($_POST['day_fin']) . "-" . on2numeric($_POST['hour_fin']) . ":" . on2numeric($_POST['min_fin']), false);
	}

	$req_setdate = $db->query("UPDATE slidezone SET date_start = '" . $date_deb . "', date_stop = '" . $date_fin . "', state = '" . $state . "' WHERE id = " . $_GET['slide']);
	header("Location: ./display.php?notif=ok");
	exit();
}
?>



<script type="text/javascript" src="../src/js/jsSimpleDatePickr.js"></script>
<script type="text/javascript" src="../src/js/jsSimpleDatePickrInit.js"></script>
<script type="text/javascript">
	function state_change(x, y)
	{
		if(x.value == "diff" && x.checked == true) document.getElementById(y).style.display = "inline-block";
		else document.getElementById(y).style.display = "none";
	}
</script>

<div id="ArchToActuDiff_display">
	<div id="center">
		<form action="?action=ArchToActuDiff&slide=<?php echo $_GET['slide'];?>" method="POST">
			<div id="deb">
				<h1>Début</h1>
				<input type="radio" name="deb" value="actu" onchange="state_change(this, 'deb_diff')" checked><span> Dès maintenant (automatique).</span><br>
				<input type="radio" name="deb" value="diff" onchange="state_change(this, 'deb_diff')"><span> Le :</span><br>
				<div id="deb_diff"><input name="day_deb" id="day_deb" type="text" value="" maxlength="10" /> à <input id="hour_deb" name="hour_deb" type="text" value="" size="2" maxlength="2" /> H <input id="min_deb" name="min_deb" type="text" value="" size="2" maxlength="2" /> min
				<div id="calendarMain"></div>
				<script type="text/javascript">calInit("calendarMain", "", "day_deb", "jsCalendar", "day", "selectedDay");</script></div>
			</div>
			<div id="fin">
				<h1>Fin</h1>
				<input type="radio" name="fin" value="actu" onchange="state_change(this, 'fin_diff')" checked><span> Jamais (Je déciderai quand l'enlever)</span><br>
				<input type="radio" name="fin" value="diff" onchange="state_change(this, 'fin_diff')"><span> Le :</span><br>
				<div id="fin_diff"><input name="day_fin" id="day_fin" type="text" value="" maxlength="10" /> à <input id="hour_fin" name="hour_fin" type="text" value="" size="2" maxlength="2" /> H <input id="min_fin" name="min_fin" type="text" value="" size="2" maxlength="2" /> min
				<div id="calendarMain2"></div>
				<script type="text/javascript">calInit("calendarMain2", "", "day_fin", "jsCalendar", "day", "selectedDay");</script></div>
			</div>
			<button>Envoyer</button>
		</form>
	</div>
</div>
