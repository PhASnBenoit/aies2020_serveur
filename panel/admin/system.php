<?php
// v1.1 by PhA 2019-02-05
session_start();
require("../../src/php/function/test_user.php");
if(!test_logged() or !isA())
{
	header('Location: ../');
 	exit();
}
$page = "system";
include("../../src/php/tool/logout.php");
require("../../src/php/db/co_db.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AIES 2020 - Etat du systeme</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="expires" content="0">
		<link rel="stylesheet" type="text/css" href="../../src/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/common_logged.css"/>
		<link rel="stylesheet" type="text/css" href="../../src/css/system.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../src/img/logo_aies.png"/>
		<script src="PourcentSD.js"></script>
		<meta http-equiv="refresh" content="20">
	</head>

	<body>
		<?php require("../../src/php/include/main_menu_admin.php"); ?>
		<div id="main-content">
			<ul id="ul_sys">
			<?php
                //$req_pourcentage = $db->query("SELECT * FROM pas INNER JOIN zones ON pas.zone_id = zones.idzone WHERE pas.Pourcentage_SD = zones.idzone ");
                
				$req_data = $db->query("SELECT * FROM pas, zones WHERE pas.zone_id = zones.idzone");
				while($data_data = $req_data->fetch())
				{
					$req_nb_slide = $db->query("SELECT count(*) as nbslide FROM slidezone WHERE state = 'actif' and zone = " . $data_data['zone_id']);
					$data_nb_slide = $req_nb_slide->fetch();
                        
					if($data_data['ModeFonc'] == "heure")
					{
						$div_modefunc = 
						"<div class=\"mode_allumage\">
							<p>Mode : <span>" . $data_data['ModeFonc'] . "</span></p>
							<p>Debut : <span>16:15</span><br>Fin : <span id=\"decale\">18h20</span></p>
						</div>";
					}
					else
					{
						$div_modefunc = "<div class=\"mode_allumage\">
							<p>Mode : <span>" . $data_data['ModeFonc'] . "</span></p></div>";
					}

					if($data_data['presence'] == "O")
					{
						$presence = "class=\"white\"";
					}
					else
					{
						$presence = "class=\"black\"";
					}

					if($data_data['temp'] == "-99.99")
					{
						$temp = "";
					}
					else
					{
						$temp = "<span class=\"temp\">" . $data_data['temp'] . " °C</span>";
					}
					
					//change la couleur du pourcentage de la carte sd
					if($data_data['Pourcentage_SD'] < 60)
                    {
                        $pourcentColor = "id=\"green\"";
                    }
                    else if($data_data['Pourcentage_SD'] > 61 && $data_data['Pourcentage_SD'] < 89 )
                    {
                        $pourcentColor = "id=\"orange\"";
                    }
                    else if($data_data['Pourcentage_SD'] > 90 && $data_data['Pourcentage_SD'] < 100)
                    {
                        $pourcentColor = "id=\"red\"";
                    }
                    
                    //si detecteur capte fumée ou non 
                    if($data_data['fumee'] == 0)
                    {
                        $detecFumee = "id=\"\"";
                    }
                    else
                    {
                        $detecFumee = "id=\"fumee\"";
                    }
                    
                    
                    
					echo 
					"
					<li>
						<div class=\"case_sys\">
							<h2>" . $data_data['name'] . "</h2>
							<h3>Zone : <span>" . $data_data['zones'] . "</span></h3>
							" . $temp . "
							<div class=\"color_state\"><img src=\"../../src/img/logo_tv.png\" alt=\"\"/><div " . $presence . " ><span>" . $data_nb_slide['nbslide'] . " slides</span></div></div>
							" . $div_modefunc . "
							<div class=\"botinfo\"><span>IP : <span>" . $data_data['ip'] . "</span></span><span>MAC : <span>" . $data_data['mac'] . "</span></span><span>Version : <span>" . $data_data['version'] . "</span></span>
							
							<span id='pourcent'>Pourcentage SD: <span>" .$data_data['Pourcentage_SD'] . "%</span><div " . $pourcentColor . ">
							</div></span>
							<br>
							<span>Détecteur de fumée : <span>" . $data_data['fumee'] . "  </span></span><div " . $detecFumee . "></div></div>
							
						</div>
					</li>
					";
				}
			?>
			
                
			</ul>
		</div>
	</body>
</html> 
