<?php
// v1.1 by PhA 2019-01-29
//
	$select = $db->query("SELECT path, theme FROM slidezone WHERE id = " . $_GET['slide']);
	$data = $select->fetch();
	$image="";
        // rechercher présence média dans fichier et les effacer.
        if ($data['theme']==2 || $data['theme']==3) {  // recherche de l'image pour effacement
            $file = fopen("..".$data['path'], 'r');
            if ($file == false)
                exit();
            while (!feof($file)) {
		$content = fgets($file, 4096);  // lecture d'une ligne
		$ligne = strstr($content, "src=");
		if ($ligne != false) {
		    $ligne=strstr($ligne,"\" alt=",  true);
		    $image=substr($ligne, 5); // enleve le début
		    break;
		} // if ligne
            } // while
            fclose($file);
        } // if theme
        echo "<p><table border=1><tr><td>voici5 : $image</td></tr></table></p>";
//        exit();
	$del = $db->query("DELETE FROM slidezone WHERE id = " . $_GET['slide']);

	unlink(".." . $data['path']);
	$res = unlink("/srv/www/htdocs".$image);
        echo "<p><table border=1><tr><td>voici5 : $res</td></tr></table></p>";
//        exit();
	header("Location: ./display.php?notif=ok");
	exit();
?>
