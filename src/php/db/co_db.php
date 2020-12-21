<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=aies2020', 'aies2020', 'aies2020');
}
catch(exeption $e)
{
	echo $e;
}
?>
