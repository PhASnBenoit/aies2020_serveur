 <div id="main-menu">
	<div id="logo">
		<a href="index.php"><img src="../src/img/letter_aies.png" alt="" /></a>
		<h2><?php echo $_SESSION['common'] ?></h2>
	</div>
	<div id="liste">
		<ul>
			<a href="display.php"><li <?php if($page == "display") echo "class=\"current\"";?>><span>Affichage</span></li></a>
			<a href="view.php?action=zone"><li <?php if($page == "view") echo "class=\"current\"";?>><span>Visualisation</span></li></a>
			<?php if(isAM()){if($page == "flash"){echo "<a href=\"flash.php\"><li class=\"current\"><span>Message flash</span></li></a>";}else{echo "<a href=\"flash.php\"><li><span>Message flash</span></li></a>";}}?>
			<?php if(isA()) echo "<a href=\"admin/	\"><li><span>Administration</span></li></a>";?>
			<a href="?logout"><li><span>Déconnexion</span></li></a>
		</ul>
	</div>
</div>
