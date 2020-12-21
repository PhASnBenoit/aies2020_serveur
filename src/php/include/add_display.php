<div id="add_display">
	<h1>Selectionner un thème de diapo</h1>
	<div id="content_theme">
		<?php //echo substr(base64_encode(time()), -30, -2); // création des dossier aléatoire pour theme, et fichier html dans rpi !  ?>
		<ul>
			<?php
				$req_aff_theme = $db->query("SELECT name, folder FROM theme ORDER BY id ASC");
				while($data_aff_theme = $req_aff_theme->fetch())
				{
					echo "
					<a href=\"../src/theme/" . $data_aff_theme['folder'] . "/config.php\"><li>
						<img src=\"../src/img/screen.png\" alt=\"\"/>
						<h3>" . $data_aff_theme['name'] . "</h3>
					</li></a>
					";
				}
			?>
		</ul>
	</div>
</div>
