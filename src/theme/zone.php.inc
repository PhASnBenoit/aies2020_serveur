<?php 
// v1.0 by PhA 2019-02-01

			$req_zone = $db->query("SELECT zones, idzone FROM zones ORDER BY idzone ASC");
			echo "<table width=100%'><tr><td>";
			$nb = $req_zone->rowCount();
			$cpt=0;
			while($data_zone = $req_zone->fetch())
			{
                                $cpt++;
                                if ($cpt > ($nb/2)) {
                                   echo "</td><td>";
                                   $cpt=0;
                                } // if
				if($data_slidedata['zone'] == $data_zone['idzone'] )  
                                    echo "<input type=\"radio\" name=\"zone\" value=\"" . $data_zone['idzone'] . "\" checked><span> " . $data_zone['zones'] . "</span></input><br>";
				else 
                                    echo "<input type=\"radio\" name=\"zone\" value=\"" . $data_zone['idzone'] . "\"><span> " . $data_zone['zones'] . 
                                    "</span></input><br>";
			}
			echo "</td></tr></table>";
?>
