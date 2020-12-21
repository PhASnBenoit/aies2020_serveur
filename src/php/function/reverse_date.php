<?php
	function reverse_date($str, $bool)
	{
		if($str == "---") return $str;
		$result = "";
		if($bool)
		{
			$result = substr($str, 0, 4) . "/" . substr($str, 4, 2) . "/" . substr($str, 6, 2) . "-" . substr($str, 8, 2) . ":" . substr($str, 10, 2);
		}
		else
		{
			$result = substr($str, 0, 4) . substr($str, 5, 2) . substr($str, 8, 2) . substr($str, 11, 2) . substr($str, 14, 2);
		}
		return $result;
	}

	function calendarToStandard($date)
	{
		return substr($date, 6, 4) . "/" . substr($date, 3, 2) . "/" . substr($date, 0, 2);
	}

	function on2numeric($num)
	{
		if(strlen($num) == 0)
		{
			return "12";
		}
		if(strlen($num) == 1)
		{
			return "0" . $num;
		}
		else
		{
			return $num;
		}
	}
?>