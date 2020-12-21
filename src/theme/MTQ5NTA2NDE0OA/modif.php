<?php 
// v1.2 by PhA 2019-02-05

session_start();

require("../../php/function/test_user.php");
if(!test_logged())
{
	header('Location: ../');
	exit();
}
require("../../php/db/co_db.php");
$page = "modif_slide";

$req_slidedata = $db->query("SELECT * FROM slidezone WHERE id = " . $_GET['slide']);
$data_slidedata = $req_slidedata->fetch();

if (isset($_POST['sub2'])) // préchargement photo
{
    $dossierR = '../../../rpi/slide/images/'; // fichier temporaire des photos  PAS TERRIBLE !!! si changement de version année
    $docRoot = '/2020/rpi/slide/images/'; // fichier temporaire des photos  PAS TERRIBLE !!! si changement de version année
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
        $date_create = "" . date('Y') . date('m') . date('d') . date('H') . date('i');
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

		unlink("../../.." . $data_slidedata['path']);
		$file = fopen("../../.." . $data_slidedata['path'], 'a');
		fputs($file, $content);

		$date_create = "" . date('Y') . date('m') . date('d') . date('H') . date('i');

		if ($_POST["priority"]=="yes")
                    $req = $db->query("UPDATE slidezone SET priority='no'");

		$req = $db->query("UPDATE slidezone SET title = '" . $_POST['title'] . "', time = " . $_POST['time'] . ", zone = " . $_POST['zone'] . ", priority = '" . $_POST['priority'] . "', date_create = '" . $date_create . "', creator = '" . $_SESSION['common'] . "' WHERE id = " . $_GET['slide']);

		header("Location: ../../../panel/display.php?notif=ok");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Modification diapo</title>
                <meta name="expires" content="0">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../../css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../teinte.css"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../img/logo_aies.png"/>
	</head>

<body onload="onload()">
	<script src="function.js"></script>
	<div id="config">
	
		<form name="form2" action="" method="POST" enctype="multipart/form-data">
			<h2>Fichier</h2>
			<div id="select_image">
				<table>
                                    <tr><td style="border: 2px white solid;" class="fichier">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                        <input type="file" name="mon_fichier" id="mon_fichier" onchange="fichier_prev(this);"/>
<?php
                                        if (isset($_FILES['mon_fichier']['name']))
                                            echo $_FILES['mon_fichier']['name'];
                                        else {
                                            // rechercher présence média dans fichier et les effacer.
                                            $file = fopen("../../.." . $data_slidedata['path'], 'r');
                                            if ($file == false)
                                                exit();
                                            $image="";
                                            while (!feof($file)) {
                                                $content = fgets($file, 4096);  // lecture d'une ligne
                                                $ligne = strstr($content, "src=");
                                                if ($ligne != false) {
                                                    $ligne=strstr($ligne,"\" alt=",  true);
                                                    $ligne=strrchr($ligne,"/");
                                                    $image=substr($ligne, 1); // enleve le début
                                                    break;
                                                } // if ligne
                                            } // while
                                            fclose($file);
                                            echo "Image chargée : " . $image;
                                        } // else
?>
                                        <input style="display: none" id="bt_send2" type="submit" name="sub2" value="fzef2" />
                                    </td></tr>
				</table>
			</div>
                </form>

	
		<form name="form1" action="" method="POST">
			<h2>Zone</h2>
<?php                   require("../zone.php.inc");    
/*
                        $req_zone = $db->query("SELECT zones, idzone FROM zones ORDER BY idzone ASC");
			while($data_zone = $req_zone->fetch())
			{
				if($data_slidedata['zone'] == $data_zone['idzone'] ) 
                                    echo "<input type=\"radio\" name=\"zone\" value=\"" . $data_zone['idzone'] . "\" checked><span> " . 
                                        $data_zone['zones'] . "</span></input><br>";
				else 
                                    echo "<input type=\"radio\" name=\"zone\" value=\"" . $data_zone['idzone'] . "\"><span> " . $data_zone['zones'] . 
                                        "</span></input><br>";
			}
			*/
?>
			<h2>Slide prioritaire</h2>
			<?php 
			if($data_slidedata['priority'] == "yes")
			{
				echo "<input type=\"radio\" name=\"priority\" value=\"yes\" style=\"margin-left: 6.2vmax\" checked><span> oui</span></input>
			<input type=\"radio\" name=\"priority\" value=\"no\"><span> non</span></input><br>";
			}
			else
			{
				echo "<input type=\"radio\" name=\"priority\" value=\"yes\" style=\"margin-left: 6.2vmax\"><span> oui</span></input>
			<input type=\"radio\" name=\"priority\" value=\"no\" checked><span> non</span></input><br>";
			}
			?>

			<h2>Durée</h2>
			<?php
			$auto = $sec4 = $sec6 = $sec8 = $sec10 = $sec12 = "";
			switch ($data_slidedata["time"])
			{
				case '4000':
					$sec4 = "selected";
				break;
				case '6000':
					$sec6 = "selected";
				break;
				case '8000':
					$sec8 = "selected";
				break;
				case '10000':
					$sec10 = "selected";
				break;
				case '12000':
					$sec12 = "selected";
				break;
				default:
					$auto = "selected";
				break;
			}
			?>
			<select id="select_time"><option value="auto" <?php echo $auto; ?>>Auto</option><option value="4" <?php echo $sec4; ?>>4s</option><option value="6" <?php echo $sec6; ?>>6s</option><option value="8" <?php echo $sec8; ?>>8s</option><option value="10" <?php echo $sec10; ?>>10s</option><option value="12" <?php echo $sec12; ?>>12s</option></select>

			<h2>Teinte</h2>
<?php                   require("../teinte.php.inc");        ?>

			<input id="time" name="time" type="hidden" value=""/>
			<input id="data" name="data" type="hidden" value=""/>
			<input id="title" name="title" type="hidden" value=""/>
			<input style="display: none" id="bt_send" type="submit" name="sub" value="fzef" />
		</form>
		<button id="bt_create" onclick="create()">Modifier la slide</button>
	</div>
	<div id="precontent">
		<?php
		$file = fopen("../../.." . $data_slidedata['path'], 'r');
		$content_file = "";
		while($data_file = fgets($file))
		{
			$content_file = $content_file . $data_file;
		}
		fclose($file);
		$file_deb = strpos($content_file, "<div");
		$file_fin = strpos($content_file, "</div>", $file_deb);
		$content_file = substr($content_file, $file_deb, (($file_fin - $file_deb) + 6));
		echo $content_file;
		?>
	</div>
<?php   if (isset($_POST['sub2'])) { ?>
            <script>
                var img = document.getElementById("image_p");
                img.src = "<?php echo $pathnameWeb;?>";
            </script>
<?php   } ?>
	<div id="botconfig">
		<textarea oninput="set_content(this, 'text')" id="change_text" type="text" name="change_text"></textarea>
	</div>

</body>
</html>
