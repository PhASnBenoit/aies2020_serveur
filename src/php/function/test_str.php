 <?php
 function test_str($str)
 {
 	for($i=0;$i<strlen($str);$i++)
 	{
 		$a = ord($str[$i]);
 		if($a >= ord("a") and $a <= ord("z") or $a >= ord("A") and $a <= ord("Z") or $a >= ord("0") and $a <= ord("9"))
        {
            continue;
        }
        if(is_numeric($str[$i]))
        {
        	continue;
        }
        return FALSE;
 	}
 	return TRUE;
 }

 function test_str_version($version)
 {
 	if(strlen($version) > 5) return false;
 	$point = false;
 	$pos = 0;
 	for($i=0;$i<strlen($version);$i++)
 	{
 		if(!$point)
 		{
 			if($i == 0)
 			{
 				if(!ctype_digit($version[$i])) return false;
 			}
 			else
 			{
 				if($version[$i] == '.')
 				{
 					if((strlen($version) - 1) == $i) return false;
 					$pos = $i;
 					$point = true;
 					continue;
 				}
 				if($i == 2) return false;
 				if(!ctype_digit($version[$i])) return false;
 			}
 		}
 		else
 		{
 			if(($i - $pos) > 2) return false;
 			if(!ctype_digit($version[$i])) return false;
 		}
 	}
 	if(!$point) return false;
 	return true;
 }

 function test_str_calendar($date)
 {
 	return true;
 }
 ?>