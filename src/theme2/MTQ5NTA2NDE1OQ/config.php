<?php 
session_start();
require("../../php/function/test_user.php");
if(!test_logged())
{
	header('Location: ../');
	exit();
}
require("../../php/db/co_db.php");
$page = "new_slide";

if(isset($_POST['zone']) and isset($_POST['priority']) and isset($_POST['time']) and isset($_POST['data']) and isset($_POST['title']))
{
	$top_content = 
	"<!DOCTYPE html>
	<html>
	<head>
	<title>Lycée Alphonse Benoit</title>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../../src/css/global.css\"/>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../../src/theme/MTQ5NTA2NDE1OQ/style.css\"/>
	<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"../../src/img/logo_aies.png\"/>
	</head>

	<body>

	";

	$bot_content =
	"
	</body>
	</html>";

	$content = $top_content . $_POST["data"] . $bot_content;
	$path = "../../../rpi/slide/";
	$newfile = substr(base64_encode(time()), -30, -2) . rand(0, 100) . ".html";
	$file = fopen($path . $newfile, 'a');
	fputs($file, $content);

	$date_create = "" . date('Y') . date('m') . date('d') . date('H') . date('i');

	$req = $db->query("INSERT INTO slidezone (title, path, time, zone, priority, state, date_create, theme, creator) VALUES ('" . $_POST['title'] . "', '/rpi/slide/" . $newfile . "', " . $_POST['time'] . ", " . $_POST['zone'] . ", '" . $_POST['priority'] . "','arch', '" . $date_create . "', 4, '" . $_SESSION['common'] . "')");

	header("Location: ../../../panel/display.php?notif=ok");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nouvelle slide</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/global.css"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../../img/logo_aies.png"/>
</head>

<body>
	<script src="function.js"></script>
	<div id="config">
		<form action="" method="POST">
			<h2>Zone</h2>
			<?php 
			$req_zone = $db->query("SELECT zones, idzone FROM zones ORDER BY idzone ASC");
			while($data_zone = $req_zone->fetch())
			{
				if($data_zone['idzone'] == 0) echo "<input type=\"radio\" name=\"zone\" value=\"" . $data_zone['idzone'] . "\" checked><span> " . $data_zone['zones'] . "</span></input><br>";
				else echo "<input type=\"radio\" name=\"zone\" value=\"" . $data_zone['idzone'] . "\"><span> " . $data_zone['zones'] . "</span></input><br>";
			}
			?>
			<h2>Slide prioritaire</h2>
			<input type="radio" name="priority" value="yes" style="margin-left: 6.2vmax"><span> oui</span></input>
			<input type="radio" name="priority" value="no" checked><span> non</span></input><br>

			<h2>Durée</h2>

			<select id="select_time"><option value="auto" selected>Auto</option><option value="4">4s</option><option value="6">6s</option><option value="8">8s</option><option value="10">10s</option><option value="12">12s</option></select>
			
			<h2>Teinte</h2>

			<div id="select_color">
				<table>
					<tr><td style="border: 2px red solid;" class="blue" onclick="teinte_change(this, 'blue');"></td><td class="lightskyblue" onclick="teinte_change(this, 'lightskyblue');"></td><td class="gainsboro" onclick="teinte_change(this, 'gainsboro');"></td><td class="orange" onclick="teinte_change(this, 'orange');"></td><td class="indianred" onclick="teinte_change(this, 'indianred');"></tr>
						<tr><td class="darkslategrey" onclick="teinte_change(this, 'darkslategrey');"></td><td class="darkolivegreen" onclick="teinte_change(this, 'darkolivegreen');"></td><td class="lightsteelblue" onclick="teinte_change(this, 'lightsteelblue');"></td><td class="pink" onclick="teinte_change(this, 'pink');"></td><td class="lemonchiffon" onclick="teinte_change(this, 'lemonchiffon');"></tr>
						</table>
					</div>

					<input id="time" name="time" type="hidden" value=""/>
					<input id="data" name="data" type="hidden" value=""/>
					<input id="title" name="title" type="hidden" value=""/>
					<input style="display: none" id="bt_send" type="submit" name="sub" value="fzef" />
				</form>
				<button id="bt_create" onclick="create()">Crée la slide</button>
			</div>

			

			<div id="precontent">
				<div id="content" class="blue">
					<h1 id="content_h1" onclick="content_select(this, 'text')">Cliquer ici pour ecrire !</h1>
					
						<?php
						$nbRow = 12 ;
						$nbCol = 4;
						echo "<table>";
						echo "<tr><th>Enseignants</th><th>Absent du</th><th>au</th><th>info</th></tr>";
						for($r=0 ; $r<$nbRow ; $r++) {
							echo "<tr>";
							for ($c=0 ; $c<$nbCol ; $c++) {
								echo "<td id='content_td' onclick='content_select(this, \"text\")'></td>";
							} // for $c
							echo "</tr>";
						} // for $r
						echo "</table>";
						?>
					

				</div>

			</div>
			<div id="botconfig">
				<textarea oninput="set_content(this, 'text')" id="change_text" type="text" name="change_text"></textarea>
			</div>

		</body>
		</html> 
