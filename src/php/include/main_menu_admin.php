 <div id="main-menu">
	<div id="logo">
		<a href="../"><img src="../../src/img/letter_aies.png" alt="" /></a>
		<h2><?php echo $_SESSION['common'] ?></h2>
	</div>
	<div id="liste">
		<ul>
			<a href="account.php"><li <?php if($page == "account") echo "class=\"current\"";?>><span>Compte</span></li></a>
			<a href="system.php"><li <?php if($page == "system") echo "class=\"current\"";?>><span>Etat du système</span></li></a>
			<a href="update.php?u=main"><li <?php if($page == "update") echo "class=\"current\"";?>><span>Mise à jour</span></li></a>
			<a href="../"><li><span>Revenir au panel</span></li></a>
			<a href="../?logout"><li><span>Déconnexion</span></li></a>
		</ul>
	</div>
</div>
