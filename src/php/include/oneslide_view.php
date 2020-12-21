<?php
if(isset($_GET['slide']))
{
	$path = "";
	$req_slide = $db->query("SELECT path FROM slidezone WHERE id = " . $_GET['slide'] . " LIMIT 1");
	if($req_slide == false)
	{
		header("Location: display.php");
		exit();
	}
	while($data_slide = $req_slide->fetch())
	{
		$path = $data_slide['path'];
	}
	
	if(strlen($path) == 0)
	{
		header("Location: display.php");
		exit();
	}
}
?>
<div id="content_zone">
	<iframe src="..<?php echo $path;?>" width="100%" height="100%" align="right" frameborder="5"> </iframe>
</div>