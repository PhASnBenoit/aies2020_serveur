<?php 
// v1.1 by PhA 2019-03-05
// script pour les diapos avec 1 image.
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

if (isset($_POST['sub2'])) // préchargement photo
        {
            $dossierR = '../../../rpi/slide/images/';
            $docRoot = '/aies/rpi/slide/images/'; // fichier temporaire des photos 
            $fichier = basename($_FILES['mon_fichier']['name']);
            $taille_maxi = 3000000;
            $taille = filesize($_FILES['mon_fichier']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['mon_fichier']['name'], '.'); 
            //Début des vérifications de sécurité...
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
            }
            if($taille>$taille_maxi)
            {
                $erreur = 'Le fichier est trop gros...';
            }
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                //On formate le nom du fichier ici...
                $fichier = strtr($fichier, 
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                $_SESSION['pathimg'] = $fichier;
                $pathname = $dossierR . $fichier . $date_create;
                $pathnameWeb = $docRoot . $fichier . $date_create;
                if(move_uploaded_file($_FILES['mon_fichier']['tmp_name'], $pathname)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    $erreur = 'Upload effectué avec succès !';
                }
                else //Sinon (la fonction renvoie FALSE).
                {
                    $erreur = 'Echec de l\'upload !';
                }
            }  // if erreur
        } // if sub2
        
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
			<link rel=\"stylesheet\" type=\"text/css\" href=\"../../src/theme/teinte.css\"/>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"../../src/theme/MTQ5NTA2NDE0OA/style.css\"/>
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

		$req = $db->query("INSERT INTO slidezone (title, path, time, zone, priority, state, date_create, theme, creator, pathimg) VALUES ('" . $_POST['title'] . "', '/rpi/slide/" . $newfile . "', " . $_POST['time'] . ", " . $_POST['zone'] . ", '" . $_POST['priority'] . "','arch', '" . $date_create . "', 3, '" . $_SESSION['common'] . "', '/rpi/slide/images/" . $_SESSION['pathimg'].$date_create . "') "); //bdd 

		header("Location: ../../../panel/display.php?notif=ok");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Nouvelle diapo</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../../css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../teinte.css"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../img/logo_aies.png"/>
	</head>

<body>
	<script src="function.js"></script>
	<div id="config">
	
		<form name="form2" action="" method="POST" enctype="multipart/form-data">
			<h2>Image</h2>
			<div id="select_image">
				<table>
                                    <tr><td style="border: 2px white solid;" class="image">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                        <input type="file" name="mon_fichier" id="mon_fichier" onchange="fichier_prev(this);"/>
<?php
                                        if (isset($_FILES['mon_fichier']['name']))
                                            echo $erreur;
?>
                                        <input style="display: none" id="bt_send2" type="submit" name="sub2" value="fzef2" />
                                    </td></tr>
				</table>
			</div>
                </form>

                <form name="form1" action="" method="POST">
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
<?php                   require("../teinte.php.inc"); ?>

			<input id="time" name="time" type="hidden" value=""/>
			<input id="data" name="data" type="hidden" value=""/>
			<input id="title" name="title" type="hidden" value=""/>
			<input style="display: none" id="bt_send" type="submit" name="sub" value="fzef" />
                </form>
                
		<button id="bt_create" onclick="create()">Créer la diapo</button>
	</div>
	<div id="precontent">
		<div id="content" class="blue">
			<h1 id="content_h1" onclick="content_select(this, 'text')">Cliquer ici pour écrire !</h1>
			<table border="1" width="1800px" height="720px"><tr align='center'>
                            <td id="content_i" align="left"><img id="image_p" class='image' src='<?php echo $pathnameWeb;?>' 
                                alt="En attente d'une image" accept="image/png, image/jpeg"></td>
                            </tr></table>
		</div>
	</div>
	<div id="botconfig">
		<textarea oninput="set_content(this, 'text')" id="change_text" type="text" name="change_text"></textarea>
	</div>

</body>
</html>
