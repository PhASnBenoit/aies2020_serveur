<?php 
// v1.2 by PhA 2019-02-05
// script pour les absences
session_start();
require("../../php/function/test_user.php");
if(!test_logged())
{
	header('Location: ../');
	exit();
}
require("../../php/db/co_db.php");
$page = "new_slide";
$date_create = "" . date('Y') . date('m') . date('d') . date('H') . date('i');

if(isset($_POST['zone']) and isset($_POST['priority']) and isset($_POST['time']) and isset($_POST['data']) and isset($_POST['title']))
{
	$top_content = 
	"<!DOCTYPE html>
	<html>
	<head>
	<title>Lycée Alphonse Benoit</title>
        <meta name=\"expires\" content=\"0\">
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../../src/css/global.css\"/>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../../src/theme/MTQ5NTA2NDE1OQ/style.css\"/>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../../src/theme/teinte.css\"/>
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

	if ($_POST["priority"]=="yes")
            $req = $db->query("UPDATE slidezone SET priority='no'");
	
	$req = $db->query("INSERT INTO slidezone (title, path, time, zone, priority, state, date_create, theme, creator) VALUES ('" . $_POST['title'] . "', '/rpi/slide/" . $newfile . "', " . $_POST['time'] . ", " . $_POST['zone'] . ", '" . $_POST['priority'] . "','arch', '" . $date_create . "', 4, '" . $_SESSION['common'] . "')");

	header("Location: ../../../panel/display.php?notif=ok");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nouvelle diapo</title>
        <meta name="expires" content="0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/global.css"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" type="text/css" href="../teinte.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../../img/logo_aies.png"/>
</head>

<body>
	<script src="function.js"></script>
	<div id="config">
		<form action="" method="POST">
			<h2>Zone</h2>
<?php			$data_slidedata['zone'] = 1;
                        require("../zone.php.inc");	
?>
                        <h2>Diapo prioritaire</h2>
			<input type="radio" name="priority" value="yes" style="margin-left: 6.2vmax"><span> oui</span></input>
			<input type="radio" name="priority" value="no" checked><span> non</span></input><br>

			<h2>Durée</h2>
			<select id="select_time"><option value="auto" selected>Auto</option><option value="4">4s</option><option value="6">6s</option><option value="8">8s</option><option value="10">10s</option><option value="12">12s</option></select>
			
			<h2>Teinte</h2>
<?php                   require("../teinte.php.inc");    
?>
                        <input id="time" name="time" type="hidden" value=""/>
                        <input id="data" name="data" type="hidden" value=""/>
                        <input id="title" name="title" type="hidden" value=""/>
                        <input style="display: none" id="bt_send" type="submit" name="sub" value="fzef" />
		</form>
		<button style="display: none" id="bt_finEdition" onclick="onFinEdition()">Fin de l'édition</button>
		<button style="display: none" id="bt_create" onclick="create()">Crée la diapo</button>
	</div>
    <div id="precontent">
        <div id="content" class="blue">
            <h1 id="content_h1" onclick="content_select()">Cliquer ici pour écrire !</h1>
<?php
            $nbRow = 12;
            $nbCol = 4;
            echo "<table>";
            echo "<tr><th>Enseignants</th><th>Absent du</th><th>au</th><th>info</th></tr>";
            for($r=0 ; $r<$nbRow ; $r++) {
                    echo "<tr>";
                    for ($c=0 ; $c<$nbCol ; $c++) {
                            echo "<td id='content_td' onclick='content_select()'>";
                            //echo "  <textarea rows=\"1\" oninput=\"set_content(this, 'text')\" class=\"styleArea\" id=\"change_text$r-$c\" name=\"change_text\"></textarea>";
                            echo "</td>";
                    } // for $c
                    echo "</tr>";
            } // for $r
            echo "</table>";
?>  
        </div>
    </div>
    <div id="botconfig">
<?php //            <textarea oninput="set_content(this, 'text')" id="change2_text" type="text" name="change2_text"></textarea> ?>
    </div>

</body>
</html> 
