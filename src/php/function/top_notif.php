<?php 
function notif($str)
{
	if(!empty($str) and strlen($str) > 1)
	{
		if($str[0] == 'G' and $str[1] == ':')
		{
			$newstr = substr($str, 2);
			echo "<div class=\"top_notif\" id=\"top_notif_good\"><p>" . $newstr . "</p></div>";
		}
		if($str[0] == 'B' and $str[1] == ':')
		{
			$newstr = substr($str, 2);
			echo "<div class=\"top_notif\" id=\"top_notif_bad\"><p>" . $newstr . "</p></div>";
		}
	}
}
?>