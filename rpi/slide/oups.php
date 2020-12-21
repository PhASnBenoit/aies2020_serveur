<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<style>
body
{
	background-color: rgb(43,57,105);
}
h1
{
	
	color: white;
	font-size: 150%;
	text-align: center;
	margin-top: 21vmax;
}
</style>
<?php if(isset($_GET['oups'])) echo "<h1>Oups ! Cette diapo a disparu, si le problème persiste contacter l'administrateur !</h1>";
	  else echo "<h1>Oups ! Aucune diapo n'est actuellement projetée sur cette affichage.</h1>";
?>

</body>
</html>